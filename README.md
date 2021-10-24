# dialogflow-php
- PHP Client Library for Dialogflow API v2

## Requirements

* [Dialogflow Agent](https://dialogflow.com/docs/reference/v2-agent-setup)
* [Google Account Credentials file](https://cloud.google.com/docs/authentication/production)
* [PHP ](http://php.net/downloads.php)
* [Composer](https://getcomposer.org/)

## Installation

- To begin, lets clone this repository
```bash
git clone https://github.com/sumithemmadi/dialogflow-php.git
cd dialogflow-php
```
- Then  install the preferred dependencies for Dialogflow.

```
composer install
```

<h2 id="before" data-text="Before you begin">Before you begin</h2>
<p>You should do the following before reading this guide:</p>
<ol>
  <li>First create a project on <a href="https://console.cloud.google.com/projectselector/iam-admin/serviceaccounts/create?supportedpurview=project">Google Cloud Console</a> then <strong>create a service account</strong> and download the private key file. </li>
  <li><strong>Create Agent</strong> in <a href="https://dialogflow.cloud.google.com/">Dialogflow</a> and get the project ID from <strong>settings</strong>.
     <blockquote>
       <p><em>for more details <a href="https://cloud.google.com/dialogflow/es/docs/quick/build-agent#create-an-agent">click here</a>.</em></p>
     </blockquote> 
   </li>
   <li>There you can see <b>Your Project ID</b>  at <b>GOOGLE PROJECT in GENERAL settings</b>
     <img src="https://user-images.githubusercontent.com/50250422/138579929-1da3be87-c588-4c37-8ebf-45b5a3b5f0d8.png"></img>
   </li>
</ol>

<h3 id="sa-create" data-text="Create a service account and download the private key file">Create a service account and download the private key file</h3>
<p>
<img src="https://user-images.githubusercontent.com/50250422/135780322-ed003c6f-cf2e-47dd-9c0f-e176e90fc91c.png"></img>
<p> Create a service account: </p>
<ol>
  <li>
    <p> In the Cloud Console, go to the <b>Create service account</b> page. </p>
    <a href="https://console.cloud.google.com/projectselector/iam-admin/serviceaccounts/create?supportedpurview=project" class="button button-primary" target="console" track-name="consoleLink" track-type="quickstart" track-metadata-position="body">Go to Create service account</a>
    <p><a href="https://console.cloud.google.com/projectselector/iam-admin/serviceaccounts/create?supportedpurview=project"><img src="https://user-images.githubusercontent.com/50250422/138555276-6a1b7cbe-e9bb-40e5-863d-c20b4dfcd63d.jpg" height=36px width=250px alt="image"></a></p>
  </li>
  <li> Select a project. </li>
  <li>
    <p> In the <b>Service account name</b> field, enter a name. The Cloud Console fills in the <b>Service account ID</b> field based on this name. </p>
    <p> In the <b>Service account description</b> field, enter a description. For example, <code translate="no" dir="ltr">Service account for quickstart</code>. </p>
  </li>
  <li> Click <b>Create and continue</b>. </li>
  <li>
    <p> Click the <b>Select a role</b> field. </p>
    <p> Under <b>Quick access</b>, click <b>Basic</b>, then click <b>Owner</b>. </p>
    <aside class="note">
      <b>Note</b>: The <b>Role</b> field affects which resources your service account can access in your project. You can revoke these roles or grant additional roles later. In production environments, do not grant the Owner, Editor, or Viewer roles. Instead, grant a <a href="/iam/docs/understanding-roles#predefined_roles">predefined role</a> or <a href="/iam/docs/understanding-custom-roles">custom role</a> that meets your needs.
    </aside>
  </li>
  <li> Click <b>Continue</b>. </li>
  <li>
    <p> Click <b>Done</b> to finish creating the service account. </p>
    <p> Do not close your browser window. You will use it in the next step. </p>
  </li>
</ol>
<p> Create a service account key: </p>
<ol>
  <li> In the Cloud Console, click the email address for the service account that you created. </li>
  <li> Click <b>Keys</b>. </li>
  <li> Click <b>Add key</b>, then click <b>Create new key</b>. </li>
  <li> Click <b>Create</b>. A JSON key file is downloaded to your computer. </li>
  <img src="https://user-images.githubusercontent.com/50250422/135780443-9d351d03-405c-49a4-9317-9131bab92041.png"></img>
  <li> Click <b>Close</b>. </li>
</ol>
</p>


## Usage

#### Text Response
```php
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
```
#### Audio Response
```php
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
```
#### Response Output 

```sh
{
    "responseId": "f7f810a1-0043-4f85-ac6c-241705aa6b8a-94f60986",
    "queryResult": {
        "queryText": "my name is sumith",
        "languageCode": "en",
        "parameters": {
            "person": {
                "name": "sumith"
            }
        },
        "allRequiredParamsPresent": true,
        "fulfillmentText": "Sorry, I was not able to understand your intention . I'm trying to get better at this thing.",
        "fulfillmentMessages": [
            {
                "text": {
                    "text": [
                        "Sorry, I was not able to understand your intention . I'm trying to get better at this thing."
                    ]
                }
            }
        ],
        "intent": {
            "name": "projects\/sumith-rwup\/agent\/intents\/f95d3add-52fb-4119-87f0-e1717181173d",
            "displayName": "user.name"
        },
        "intentDetectionConfidence": 1
    }
}
```
## Nginx Server(Production)
- **Create a nginx server** 

- Run below command to generate **nginx.conf** file for your server.
```
~$ php nginx-conf.php
```
- Now **nginx.conf** will be created in you local directory.
- move the  **nginx.conf** file to /etc/nginx/.
- now start the nginx server (Default port will be 8080 change )
- Then start php-cgi on port 9000

## LICENSE
   Apache License
   Version 2.0, January 2004
   http://www.apache.org/licenses/

   Copyright  2021  <b>sumithemmadi</b>

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

   http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.

