<?php
namespace Google\Cloud\Samples\Dialogflow;

require __DIR__ . "/vendor/autoload.php";

// Save Google Account Credentials json file in root directory
// make sure that Google Account Credentials JSON file and this file are in same directory.

$google_application_credentials = "[GOOGLE ACCOUNT_CREDENTIALS_JSON_FILE]";

//PROJECT ID
// Please Change "[ENTER_PROJECT_ID]" with you dialogflow project ID
$projectId    = "[ENTER_PROJECT_ID]";
$languageCode = 'en-US';
$sessionId    = "123456789";

// Get Response from audio input.
$path = "test/hello.wav";

$audioResponse = get_response_from_audio($google_application_credentials,$projectId,$path, $sessionId, $languageCode);
echo $audioResponse;

?>
