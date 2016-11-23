# secucard connect PHP SDK

[![Latest Stable Version](https://poser.pugx.org/secucard/secucard-connect/v/stable)](https://packagist.org/packages/secucard/secucard-connect)
[![Total Downloads](https://poser.pugx.org/secucard/secucard-connect/downloads)](https://packagist.org/packages/secucard/secucard-connect)
[![License](https://poser.pugx.org/secucard/secucard-connect/license)](https://packagist.org/packages/secucard/secucard-connect)

## Requirements

PHP 5.5.0 and later.

## Composer

You can install the bindings via [Composer](http://getcomposer.org/). Add this to your `composer.json`:

```json
{
  "require": {
    "secucard/secucard-connect":"~v1.0"
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

Simple usage with client credentials looks like:

```php
include "vendor/autoload.php";

$config = array();

$credentials = new ClientCredentials('your-id','your-secret')

$fp = fopen("/tmp/secucard_php_test.log", "a");
$logger = new secucard\client\log\Logger($fp, true);

// general storage, here used shared for tokens and internal caching, but recommendation is to split up in two 
 $store = new FileStorage('your-storage-file-path');
 
// create Secucard client
$secucard = new SecucardConnect($config, $logger, $store, $store, $credentials);

// use secucard client to get available loyalty/cards list
$list = $secucard->Loyalty->Cards->getList();
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
