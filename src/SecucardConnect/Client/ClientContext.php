<?php

namespace SecucardConnect\Client;


use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use SecucardConnect\Event\EventDispatcher;

/**
 * Gathers all resources shared across different layers and components of the application.
 * @package SecucardConnect\Client
 */
class ClientContext
{
    /**
     * @var Client
     */
    public $httpClient;

    /**
     * @var array
     */
    public $config;

    /**
     * @var LoggerInterface
     */
    public $logger;

    /**
     * @var StorageInterface
     */
    public $storage;

    /**
     * @var EventDispatcher
     */
    public $eventDispatcher;
}
