<?php
//                                 Apache License
//                            Version 2.0, January 2004
//                         http://www.apache.org/licenses/

//    Copyright 2021 sumithemmadi
//    Licensed under the Apache License, Version 2.0 (the "License");
//    you may not use this file except in compliance with the License.
//    You may obtain a copy of the License at

//        http://www.apache.org/licenses/LICENSE-2.0

//    Unless required by applicable law or agreed to in writing, software
//    distributed under the License is distributed on an "AS IS" BASIS,
//    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
//    See the License for the specific language governing permissions and
//    limitations under the License.

namespace Google\Cloud\Samples\Dialogflow;


require __DIR__ . "/vendor/autoload.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header(
    "Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"
);

// Save Google Account Credentials json file as 'service-account-file.json'
//make sure that Google Account Credentials JSON file and this file are in same directory.
$google_application_credentials = "config.json";

//PROJECT ID
// Please Change "[ENTER_PROJECT_ID]" with you dialogflow project ID
$projectId = "sumith-bot";
$languageCode = 'en-US';
$sessionId   = "123456789";

// Get response from text input.
$text = "hi";

$queryResponse = get_response_from_text($google_application_credentials,$projectId,$sessionId,$languageCode,$text);

echo $queryResponse;


// Get Response from audio input.
// $path = "test/hello.wav";

// $audioResponse = get_response_from_audio($google_application_credentials,$projectId,$path, $sessionId, $languageCode);
// echo $audioResponse;

?>
