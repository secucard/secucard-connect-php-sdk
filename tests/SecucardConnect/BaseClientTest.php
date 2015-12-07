<?php

namespace SecucardConnect;

use Psr\Log\LoggerInterface;
use SecucardConnect\Auth\ClientCredentials;
use SecucardConnect\Client\FileStorage;
use SecucardConnect\Util\Logger;

/**
 * @covers secucard\Client
 */
class BaseClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Api client
     * @var SecucardConnect
     */
    protected $client;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Function to set-up client correctly
     */
    protected function setUp()
    {
        $config = array(
            'base_url' => 'https://connect-dev10.secupay-ag.de',
            'debug' => true
        );

//        $fp = fopen("/tmp/secucard_php_test.log", "a");
        $fp = fopen("php://stdout", "a");
        $this->logger = new Logger($fp, true);


        $store = new FileStorage('/tmp/.secucardstore');

        $this->client = new SecucardConnect($config, $this->logger, $store, $store, $this->getCredentials());
    }

    /**
     * @test
     */
    public function testClientCreation()
    {
        $this->assertFalse(empty($this->client));
    }

    /**
     * Override in tests to set special credentials.
     * @return ClientCredentials
     */
    protected function getCredentials()
    {
        return new ClientCredentials('your-id', 'your-secret');
    }
}