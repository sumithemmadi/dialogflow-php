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
$json_path = $config_data['GOOGLE_APPLICATION_CREDENTIALS'];

// Dialogflow Session Id
$dialogflow_session = $config_data['DIALOGFLOW_SESSION_ID'];

// PTOJECT ID
$projectId = $config_data['PROJECT_ID'];

//bot name
$botname = $config_data['BOTNAME'];

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->sender) && !empty($data->message)) {
    $sender = $data->sender;
    $text   = $data->message;
    http_response_code(200);
    
    //$sessionsClient
    $sessionsClient = $dialogflow_session;
    $languageCode   = 'en-US';
    // new session
    $test           = array(
        'credentials' => $json_path
    );
    $sessionsClient = new SessionsClient($test);
    $session        = $sessionsClient->sessionName($projectId, $dialogflow_session ?: uniqid());
    // create text input
    $textInput      = new TextInput();
    $textInput->setText($text);
    $textInput->setLanguageCode($languageCode);
    // create query input
    $queryInput = new QueryInput();
    
    $queryInput->setText($textInput);
    
    // get response and relevant info
    $response       = $sessionsClient->detectIntent($session, $queryInput);
    $queryResult    = $response->getQueryResult();
    $queryText      = $queryResult->getQueryText();
    $intent         = $queryResult->getIntent();
    $displayName    = $intent->getDisplayName();
    $confidence     = $queryResult->getIntentDetectionConfidence();
    $fulfilmentText = $queryResult->getFulfillmentText();
    printf('Fulfilment text: %s' . PHP_EOL, $fulfilmentText);
    
    
    //print parameters
    $key = 0;
    //$params = [];
    if ($response->getQueryResult()->getParameters()->getFields()->count()) {
        foreach ($response->getQueryResult()->getParameters()->getFields() as $key => $value) {
            $params[$key] = $value->serializeToJsonString();
            // Uncomment below line to print  parameters
            // echo "$params[$key]";
            // printf('%s' . PHP_EOL, $params[$key]);
            
        }
    }
} else {
    http_response_code(400);
    // Error
    echo "Error ❌";
}
?>