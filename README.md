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

```bash
composer install
```

- Or install latest version with below command:
```bash
composer require google/cloud-dialogflow
```

## Usage
- Download the Google Account Credentials JSON file for your v2 Dialogflow agent into the diaglogflow-php folder

- Make sure v2 API is enabled in Dialogflow
![client_secret_json_download_1](https://user-images.githubusercontent.com/50250422/135780264-48c383ce-7942-418f-baf8-703b5257fd30.png)
- Click on the service account email address.
- You will be taken to the Google Cloud Console.
- Click on the Create Service Account link at the top of the console menu
- Provide a suitable name for the service account
- Select Project -> Owner in the Role dropdown box
- Make sure you check the Furnish a new private key box. Keep the key type as JSON
![client_secret_json_download_2](https://user-images.githubusercontent.com/50250422/135780322-ed003c6f-cf2e-47dd-9c0f-e176e90fc91c.png)
- Click on the create
![create_key_slideout](https://user-images.githubusercontent.com/50250422/135780443-9d351d03-405c-49a4-9317-9131bab92041.png)
- You will be prompted to save the Google Account Credentials JSON file. Save the file as `service-account-file.json` to the dialogflow-php folder.
> Make sure that `service-account-file.json` file is in  main directory
- Now create a web server and send a post request.
```sh
curl -Xs POST http://localhost:8080/dialogflow.php \
-d '{"sender":"sumith","message":"my name is sumith"}'
```
```sh
~$ curl -sX POST http://localhost:8080/dialogflow.php \
-d '{"sender":"sumith","message":"my name is sumith"}'

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

