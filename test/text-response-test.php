<?php
namespace Google\Cloud\Samples\Dialogflow;

require __DIR__ . "/vendor/autoload.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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

?>
