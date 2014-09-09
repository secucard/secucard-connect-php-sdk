<?php

namespace secucard\tests\Api;

use secucard\client\api\Client;

/**
 * @covers secucard\client\api\Client
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Api client
     * @var secucard\client\api\Client
     */
    protected $client;

    /**
     * Function to set-up client correctly
     */
    protected function setUp()
    {
        $config = array('base_url'=>'https://core-dev4.secupay-ag.de/app.core.connector/api/v2/',
            'auth_path'=>'/app.core.connector/oauth/token',
            'client_id'=>'webapp',
            'client_secret'=>'821fc7042ec0ddf5cc70be9abaa5d6d311db04f4679ab56191038cb6f7f9cb7c',
            'username'=>'sten@beispiel.net',
            'password'=>'secrets',);
        $fp = fopen("/tmp/secucard_php_test.log", "a");
        $logger = new \secucard\client\log\Logger($fp, true);
        $subscriber = new \secucard\client\log\GuzzleSubscriber($logger);
        $this->client = new \secucard\client\api\Client($config, $subscriber);
    }

    /**
     * @test
     */
    public function testClientCreation()
    {
        $this->assertFalse(empty($this->client));
    }
}