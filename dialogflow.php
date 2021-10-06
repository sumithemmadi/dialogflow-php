<?php                  
/*                              Apache License
                           Version 2.0, January 2004
                        http://www.apache.org/licenses/

   Copyright 2021 sumithemmadi
   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
*/

namespace Google\Cloud\Samples\Dialogflow;
use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Load env vars from .env
if (class_exists('\Symfony\Component\Dotenv\Dotenv')) {
    $dotenv = new \Symfony\Component\Dotenv\Dotenv();
    if (is_readable(__DIR__.'/.env')) $dotenv->load(__DIR__.'/.env');
}


// Save Google Account Credentials json file as 'service-account-file.json'
//make sure that Google Account Credentials JSON file and this file are in same directory.
$google_application_credentials = getenv('GOOGLE_APPLICATION_CREDENTIALS');


//PROJECT ID
if (getenv('PROJECT_ID') != "[PROJECT_ID]") {
    $get_json_data    = file_get_contents($google_application_credentials);
    $decode_json_data = json_decode($get_json_data, TRUE);
    $projectId        = $decode_json_data['project_id'];
} else {
    $projectId        = getenv('PROJECT_ID');
}



$data = json_decode(file_get_contents("php://input"));


// Function to get JSON response.
function  get_response($projectId,$google_application_credentials, $text, $sessionId) {
    // new session
    $test           = array(
        'credentials' => $google_application_credentials
    );
    $sessionsClient = $sessionId;
    $sessionsClient = new SessionsClient($test);
    $session        = $sessionsClient->sessionName($projectId, $sessionId);

    // create text input
    $textInput      = new TextInput();
    $textInput->setText($text);
    // set language
    $textInput->setLanguageCode('en-US');

    // create query input
    $queryInput = new QueryInput();
    $queryInput->setText($textInput);

    // Response
    $dialogflow_response       = $sessionsClient->detectIntent($session, $queryInput);
    $json_resp      = $dialogflow_response->serializeToJsonString();
    $json_response  = json_encode(json_decode($json_resp),JSON_PRETTY_PRINT);
    return $json_response;
}

function  get_response($projectId,$google_application_credentials, $text, $sessionId) {
    // new session
    $sessionId = $data->sid;
    $text   = $data->message;
    http_response_code(200);
    
    // new session
    $test           = array(
        'credentials' => $google_application_credentials
    );
    $sessionsClient = $sessionId;
    $sessionsClient = new SessionsClient($test);
    $session        = $sessionsClient->sessionName($projectId, $sessionId ?: uniqid());

    // create text input
    $textInput      = new TextInput();
    $textInput->setText($text);
    $textInput->setLanguageCode('en-US');

    // create query input
    $queryInput = new QueryInput();
    $queryInput->setText($textInput);
    
    // Response
    $response       = $sessionsClient->detectIntent($session, $queryInput);
    $json_response  = $response->serializeToJsonString();
    $queryResult    = $response->getQueryResult();
    $queryText      = $queryResult->getQueryText();
    $intent         = $queryResult->getIntent();
    $displayName    = $intent->getDisplayName();
    $confidence     = $queryResult->getIntentDetectionConfidence();
    $fulfilmentText = $queryResult->getFulfillmentText();
    
    //print JSON response
    //printf('%s' . PHP_EOL,json_encode(json_decode($json_response),JSON_PRETTY_PRINT));
    // print response
    printf("<h3>RESPONSE</h3>");
    printf("<b>Fulfilment Text</b>: %s<br>" . PHP_EOL, $fulfilmentText);
    printf("<b>Display Name   </b>: %s<br>" . PHP_EOL, $displayName);
    printf("<b>Query Text     </b>: %s<br>" . PHP_EOL, $queryText);

    //print parameters
    if ($response->getQueryResult()->getParameters()->getFields()->count()) {
        foreach ($response->getQueryResult()->getParameters()->getFields() as $key => $value) {
            $params[$key] = $value->serializeToJsonString();
            printf("<h3>PARAMETERS</h3>");
            printf("<b>Parameter</b>: %s<br>" . PHP_EOL, $key);
            printf("%s<br>" . PHP_EOL, json_encode(json_decode($params[$key]),JSON_PRETTY_PRINT));
        }
    }
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($data->message)) {
     if(!empty($data->sid)) {
          //sessionId
          $sessionId = $data->sid;
     } else {
          // Generate Random Session ID if sid object is not found in JSON post request.
          $sessionId = uniqid('sid-');
     }
     $text   = $data->message;
     http_response_code(200);
     $response = get_response($projectId,$google_application_credentials, $text, $sessionId);
     echo $response;
} else {
    http_response_code(400);
    // Error
    echo "Error ❌";
}
?>
