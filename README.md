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

```php
require 'vendor/autoload.php';

use Google\Cloud\SecretManager\V1\Replication;
use Google\Cloud\SecretManager\V1\Replication\Automatic;
use Google\Cloud\SecretManager\V1\Secret;
use Google\Cloud\SecretManager\V1\SecretManagerServiceClient;

$client = new SecretManagerServiceClient();

$secret = $client->createSecret(
    SecretManagerServiceClient::projectName('[MY_PROJECT_ID]'),
    '[MY_SECRET_ID]',
    new Secret([
        'replication' => new Replication([
            'automatic' => new Automatic()
        ])
    ])
);

printf(
    'Created secret: %s' . PHP_EOL,
    $secret->getName()
);
```
## Version
This component is considered GA (generally available). As such, it will not introduce backwards-incompatible changes in any minor or patch releases. We will address issues and requests with the highest priority.
