# secucard connect PHP client library

[![Latest Stable Version](https://poser.pugx.org/secucard/secucard-connect-php-client-lib/v/stable)](https://packagist.org/packages/secucard/secucard-connect-php-client-lib)
[![Total Downloads](https://poser.pugx.org/secucard/secucard-connect-php-client-lib/downloads)](https://packagist.org/packages/secucard/secucard-connect-php-client-lib)
[![License](https://poser.pugx.org/secucard/secucard-connect-php-client-lib/license)](https://packagist.org/packages/secucard/secucard-connect-php-client-lib)

## Requirements

PHP 5.3.0 and later.

## Composer

You can install the bindings via [Composer](http://getcomposer.org/). Add this to your `composer.json`:

```json
{
  "require": {
    "secucard/secucard-connect-php-client-lib":"~0.0.5"
  }
}
```

Then install via:

```bash
composer install
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Getting Started

Simple usage looks like:

```php
include "vendor/autoload.php";

$config = array(
    'client_id' => 'your_client_id',
    'client_secret' => 'your_client_secret',
);

// Setup dummy log file
$fp = fopen("/tmp/secucard_php_test.log", "a");
$logger = new secucard\client\log\Logger($fp, true);

// create Secucard client
$secucard = new secucard\Client($config, $logger);

// use secucard client to get available loyalty/cards list
$data = $secucard->Loyalty->Cards->getList(array());
```

## Documentation

Please see http://developer.secucard.com/api/index.html for up-to-date documentation.

## Tests

In order to run tests first install [PHPUnit](http://packagist.org/packages/phpunit/phpunit) via [Composer](http://getcomposer.org/):

```bash
composer update --dev
```

To run the test suite:

```bash
./vendor/bin/phpunit
```
