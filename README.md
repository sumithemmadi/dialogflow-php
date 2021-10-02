# dialogflow-php

<b>Secret Manager for PHP Overview</b>
## Installation
To begin, install the preferred dependency manager for PHP, Composer.

Now to install just this component:
```bash
$ composer require google/cloud-secret-manager
```
Or to install the entire suite of components at once:
```bash
$ composer require google/cloud
```
This component supports both REST over HTTP/1.1 and gRPC. In order to take advantage of the benefits offered by gRPC (such as streaming methods) please see our gRPC installation guide.

## Authentication
Please see our Authentication guide for more information on authenticating your client. Once authenticated, you'll be ready to start making requests.

## Sample

```json
{
  "GOOGLE_APPLICATION_CREDENTIALS": "service-account-file.json",
  "DIALOGFLOW_SESSION_ID": "9ab552d6-9c25-7a82-fc39-c796bcd1d39c",
  "PROJECT_ID": "sumith-rwup",
  "BOTNAME": "Rose"
}
```
## Version
This component is considered GA (generally available). As such, it will not introduce backwards-incompatible changes in any minor or patch releases. We will address issues and requests with the highest priority.
