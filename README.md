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

## Download the Google Account Credentials
- Download the Google Account Credentials JSON file for your v2 Dialogflow agent into the diaglogflow-php folder

- Make sure v2 API is enabled

- Click on the service account email address.
- You will be taken to the Google Cloud Console.
- Click on the Create Service Account link at the top of the console menu
- Provide a suitable name for the service account
- Select Project -> Owner in the Role dropdown box
- Make sure you check the Furnish a new private key box. Keep the key type as JSON
- Click on the create link
- You will be prompted to save the Google Account Credentials JSON file. Save the file as `service-account-file.json` to the dialogflow-php folder.

##usage
-  Create a `config.json`  file with below file contents. 
```json
{
  "GOOGLE_APPLICATION_CREDENTIALS": "service-account-file.json",
  "DIALOGFLOW_SESSION_ID": "Dialogflow-session-id",
  "PROJECT_ID": "project-id",
  "BOTNAME": "bot-name"
}
```
- Or Rename `config.example.json` file with `config.json`. Open `config.json` with any text editor and change everything.

1. <b>GOOGLE_APPLICATION_CREDENTIALS</b> : Replace `service-account-file.json` in above json with the [google account credentials](https://cloud.google.com/docs/authentication/production) file name downloaded from gcloud.
> Note :- You should place your [Google Account Credentials](https://cloud.google.com/docs/authentication/production) file, `config json` and `dialogflow.php` in the root dictionary on your server. It's on you to ensure that [google account credentials](https://cloud.google.com/docs/authentication/production) file  and `config.json` file are  not accessible from the web!
2. <b>DIALOGFLOW_SESSION_ID</b> : Replace `Dialogflow-session-id`
3. <b>PROJECT_ID</b> : Replace `project-id` with your project ID.
4. <b>BOTNAME</b> (optional) : Replace `bot-name` with any other name.

- Now create a web server and send a post request.
```sh
curl -X POST http://localhost:8080/dialogflow.php \
-d '{"sender":"sumith","message":"how are you ?"}'
```
```sh
~$ curl -X POST http://localhost:8080/dialogflow.php \
-d '{"sender":"sumith","message":"how are you ?"}'

Fulfilment text: I'm great thanks for asking.
```

## Testing
- After creating `config.json` file  create a php server.
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

