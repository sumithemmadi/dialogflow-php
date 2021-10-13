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
<!--
- To update all dependencies .

```
composer update
```
-->

<h2 id="before" data-text="Before you begin">Before you begin</h2>
<p>You should do the following before reading this guide:</p>
<ol>
  <li>Read <a href="/dialogflow/docs/basics">Dialogflow basics</a>. </li>
  <li>Read <a href="/dialogflow/docs/editions">Editions</a>. </li>
</ol>

<h3 id="sa-create" data-text="Create a service account and download the private key file">Create a service account and download the private key file</h3>
<p>
<img src="https://user-images.githubusercontent.com/50250422/135780322-ed003c6f-cf2e-47dd-9c0f-e176e90fc91c.png"></img>
<p> Create a service account: </p>
<ol>
  <li>
    <p> In the Cloud Console, go to the <b>Create service account</b> page. </p>
    <a href="https://console.cloud.google.com/projectselector/iam-admin/serviceaccounts/create?supportedpurview=project" class="button button-primary" target="console" track-name="consoleLink" track-type="quickstart" track-metadata-position="body">Go to Create service account</a>
    <p><a href="https://console.cloud.google.com/projectselector/iam-admin/serviceaccounts/create?supportedpurview=project"><img src="https://user-images.githubusercontent.com/50250422/136433280-d2d716a3-adcf-451a-90ac-f9a213e2ace6.jpg" height=40px width=200px alt="image"></a></p>
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

<!--
## Usage

Download the Google Account Credentials JSON file for your v2 Dialogflow agent into the diaglogflow-php folder

Make sure v2 API is enabled in Dialogflow
![client_secret_json_download_1](https://user-images.githubusercontent.com/50250422/135780264-48c383ce-7942-418f-baf8-703b5257fd30.png)
Click on the service account email address.
You will be taken to the Google Cloud Console.
Click on the Create Service Account link at the top of the console menu

Provide a suitable name for the service account

Select Project -> Owner in the Role dropdown box
Make sure you check the Furnish a new private key box. Keep the key type as JSON
![client_secret_json_download_2](https://user-images.githubusercontent.com/50250422/135780322-ed003c6f-cf2e-47dd-9c0f-e176e90fc91c.png)
- Click on the create

![create_key_slideout](https://user-images.githubusercontent.com/50250422/135780443-9d351d03-405c-49a4-9317-9131bab92041.png)
- You will be prompted to save the Google Account Credentials JSON file. Save the file as `service-account-file.json` to the dialogflow-php folder.
> Make sure that `service-account-file.json` file is in  main directory
- Now create a web server and send a post request.
-->


## Usage
```sh

curl -sX POST  http://localhost:8080/dialogflow.php -d '{"sid":"1234567","message":"hi"}'
```
```sh
~$ curl -sX POST http://localhost:8080/dialogflow.php -d '{"sid":"12345678","message":"my name is sumith"}'

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

## Testing
- After saving the `service-account-file.json` file in main directory.
- start a PHP server (for testing purpose)
```php
php -S localhost:8080
```
- Now open http://localhost:8080 in any web browser.

- Now enter any name in `sender` field and enter any message in `message` field.
- Click send message you will see `fullfilment message` 
> Note: Wait untill you get fulfilment message.

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

