<?php
/**
 * Created by IntelliJ IDEA.
 * User: tk
 * Date: 03.12.15
 * Time: 17:10
 */

namespace SecucardConnect\Client;


use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

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
     * ClientContext constructor.
     * @param Client $httpClient
     * @param array $config
     * @param LoggerInterface $logger
     */
    public function __construct(Client $httpClient, array $config, LoggerInterface $logger)
    {
        $this->httpClient = $httpClient;
        $this->config = $config;
        $this->logger = $logger;
    }
}