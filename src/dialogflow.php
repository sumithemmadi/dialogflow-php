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

use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\AudioEncoding;
use Google\Cloud\Dialogflow\V2\InputAudioConfig;


// require __DIR__ . "/../vendor/autoload.php";


// Function to get JSON response.
function get_response_from_text(
    $google_application_credentials,
    $projectId,
    $sessionId,
    $languageCode,
    $text
) {
    // new session
    $test = [
        "credentials" => $google_application_credentials,
    ];
    $sessionsClient = $sessionId;
    $sessionsClient = new SessionsClient($test);
    $session = $sessionsClient->sessionName($projectId, $sessionId);

    // create text input
    $textInput = new TextInput();
    $textInput->setText($text);
    // set language
    $textInput->setLanguageCode($languageCode);

    // create query input
    $queryInput = new QueryInput();
    $queryInput->setText($textInput);

    // Response
    $dialogflow_response = $sessionsClient->detectIntent($session, $queryInput);
    $json_resp = $dialogflow_response->serializeToJsonString();
    $json_response = json_encode(json_decode($json_resp), JSON_PRETTY_PRINT);
    
    return $json_response;
}


// Function to get JSON response from audio input.
function get_response_from_audio(
    $google_application_credentials,
    $projectId,
    $path,
    $sessionId,
    $languageCode
)
{
    // new session
    // putenv('GOOGLE_APPLICATION_CREDENTIALS=/config.json');
    $test = [
        "credentials" => $google_application_credentials,
    ];
    $sessionsClient = $sessionId;
    $sessionsClient = new SessionsClient($test);
    $session = $sessionsClient->sessionName($projectId, $sessionId ?: uniqid());

    // load audio file
    $inputAudio = file_get_contents($path);

    // hard coding audio_encoding and sample_rate_hertz for simplicity
    $audioConfig = new InputAudioConfig();
    $audioConfig->setAudioEncoding(AudioEncoding::AUDIO_ENCODING_LINEAR_16);
    $audioConfig->setLanguageCode($languageCode);
    $audioConfig->setSampleRateHertz(16000);

    // create query input
    $queryInput = new QueryInput();
    $queryInput->setAudioConfig($audioConfig);

    // get response and relevant info
    $dialogflow_response = $sessionsClient->detectIntent($session, $queryInput, ['inputAudio' => $inputAudio]);
    $json_resp = $dialogflow_response->serializeToJsonString();
    $json_response = json_encode(json_decode($json_resp), JSON_PRETTY_PRINT);
    $sessionsClient->close();
    return $json_response;
}

?>
