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

// Get response from text input.
$text = "hi";

$queryResponse = get_response_from_text($google_application_credentials,$projectId,$sessionId,$languageCode,$text);

echo $queryResponse;

?>
