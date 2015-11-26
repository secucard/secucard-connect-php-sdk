<?php

namespace SecucardConnect;

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
     * Function to set-up client correctly
     */
    protected function setUp()
    {
        $config = array(
            'base_url'=>'https://connect-dev10.secupay-ag.de',
            'debug'=>true,
            'client_id'=>'f0478f73afe218e8b5f751a07c978ecf',
            'client_secret'=>'30644327cfbde722ad2ad12bb9c0a2f86a2bee0a2d8de8d862210112af3d01bb',
//            'username'=>'sten@beispiel.net',
//            'password'=>'secrets',
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