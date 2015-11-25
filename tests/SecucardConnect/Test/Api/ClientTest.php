<?php

namespace SecucardConnect\Test\Api;
use SecucardConnect\SecucardConnect;
use SecucardConnect\Util\Logger;

/**
 * @covers secucard\Client
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Api client
     * @var SecucardConnect
     */
    protected $client;

    /**
     * Function to set-up client correctly
     */
    protected function setUp()
    {
        $config = array(
            //'base_url'=>'https://core-dev10.secupay-ag.de',
            //'auth_path'=>'/app.core.connector/oauth/token',
            //'api_path'=>'/app.core.connector/api/v2',
            //'debug'=>true,
            'client_id'=>'webapp',
            'client_secret'=>'821fc7042ec0ddf5cc70be9abaa5d6d311db04f4679ab56191038cb6f7f9cb7c',
            'username'=>'sten@beispiel.net',
            'password'=>'secrets',
        );

        $fp = fopen("/tmp/secucard_php_test.log", "a");
        $logger = new Logger($fp, true);

        $this->client = new SecucardConnect($config, $logger);
    }

    /**
     * @test
     */
    public function testClientCreation()
    {
        $this->assertFalse(empty($this->client));
    }
}