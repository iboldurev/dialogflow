Api.ai PHP sdk
==============

This is an unofficial php sdk for [Api.ai][1] and it's still in progress...

```
Api.ai: Build brand-unique, natural language interactions for bots, applications and devices.
```

## Install:

Via composer:

```
$ composer require iboldurev/api-ai-php
```

## Usage:

Using the low level `Client`:

```php
require_once __DIR__.'/vendor/autoload.php';

use Api\Client;

$client = new Client('access_token');

$query = $client->get('query', [
    'query' => 'Hello',
]);

$response = json_decode((string) $query->getBody(), true);
```

Some examples are describe in the [iboldurev/api-ai-php-example][2] repository.

[1]: https://api.ai
[2]: https://github.com/iboldurev/api-ai-php-example
