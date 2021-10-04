<?php
/*
                                 Apache License
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
require __DIR__ . '/vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$config_json = file_get_contents("config.json");
$config_data = json_decode($config_json, TRUE);

//Path to GOOGLE_APPLICATION_CREDENTIALS
$google_application_credentials = $config_data['GOOGLE_APPLICATION_CREDENTIALS'];

// Session ID, can be any string for this purpose. However, if you are going to be using the client library to manage an entire conversation, your session_ID must be the same across an entire
$sessionId= $config_data['SESSION_ID'];

// PROJECT ID
$projectId = $config_data['PROJECT_ID'];

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->sender) && !empty($data->message)) {
    $sender = $data->sender;
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
    $queryResult    = $response->getQueryResult();
    $queryText      = $queryResult->getQueryText();
    $intent         = $queryResult->getIntent();
    $displayName    = $intent->getDisplayName();
    $confidence     = $queryResult->getIntentDetectionConfidence();
    $fulfilmentText = $queryResult->getFulfillmentText();

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
} else {
    http_response_code(400);
    // Error
    echo "Error ❌";
}
?>
