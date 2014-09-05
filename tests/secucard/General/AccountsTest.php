<?php

namespace secucard\tests\General;

use secucard\models\General\Accounts;
use secucard\client\api\Client;

/**
 * @covers secucard\models\General\Accounts
 */
class AccountsTest extends \PHPUnit_Framework_TestCase
{

    protected $client;

    protected function setUp()
    {
        $config = array('base_url'=>'https://core-dev4.secupay-ag.de',
            'auth_path'=>'/app.core.connector/oauth/token',
            'client_id'=>'webapp',
            'client_secret'=>'821fc7042ec0ddf5cc70be9abaa5d6d311db04f4679ab56191038cb6f7f9cb7c',
            'username'=>'sten@beispiel.net',
            'password'=>'secrets');
        $this->client = new \secucard\client\api\Client($config);
    }

    public function testGetList()
    {
        $list = $this->client->general->accounts->getList(array('blabla'=>'uff'));
        // test also the BaseCollection for iterating:
        foreach ($list as $key => $value)
        {
            echo 'processing key: ' . $key . "\n";
            echo 'value: ' . $value->id . "\n";
            if (!$value) {
                echo 'error';
            }
        }

        $this->assertFalse(empty($list));
    }

    public function testGetItem()
    {
        $account = $this->client->general->accounts->get('acc_577091');

        $this->assertFalse(empty($account));
    }
}