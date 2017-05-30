# PHP SDK Guide

## Getting Started

### Initialize the client
```php
include "vendor/autoload.php";

$config = array(
    'base_url' => 'https://connect-testing.secupay-ag.de',
    'debug'    => true
);

// payment product always uses ClientCredentials
$clientId = '...';
$clientSecret = '...';
$credentials = new ClientCredentials($clientId, $clientSecret);

// This just the internal logger impl. for demo purposes! For production you may use a library like Monolog.
$logger = new Logger(fopen("php://stdout", "a"), true);

// Use DummyStorage for demo purposes only, in production use FileStorage or your own implementation.
$store = new DummyStorage();

// create Secucard client
$secucard = new SecucardConnect($config, $logger, $store, $store, $credentials);
```

### List all existing customers (without pagination)
```php
$service = $secucard->payment->customers;

$customers = $service->getList();
if (empty($customers)) {
    throw new Exception("No Customers found.");
}

print_r($customers);
```

### List all existing customers (with pagination)
If you have many customers, you would need following code to get them all.
```php
$service = $secucard->payment->customers;

$expiration_time = '5m';
$customers = [];
$list = $service->getScrollableList([], $expiration_time);
while (count($list) != 0) {
    $customers = array_merge($customers, $list->items);
    $list = $service->getNextBatch($list->scrollId);
}

if (empty($customers)) {
    throw new Exception("No Customers found.");
}

print_r($customers);
```
