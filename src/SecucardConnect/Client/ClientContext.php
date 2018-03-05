<?php

namespace SecucardConnect\Client;

use Http\Client\Common\HttpMethodsClient;
use Psr\Log\LoggerInterface;
use SecucardConnect\Auth\OauthProvider;
use SecucardConnect\Event\EventDispatcher;

/**
 * Gathers all resources shared across different layers and components of the application.
 * @package SecucardConnect\Client
 */
class ClientContext
{
    /**
     * @var HttpMethodsClient
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

    /**
     * @var OauthProvider
     */
    public $oauthProvider;
}
