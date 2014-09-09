<?php

namespace secucard\tests\General;

use secucard\models\General\Accounts;
use secucard\tests\Api\ClientTest;

/**
 * @covers secucard\models\General\Accounts
 */
class AccountsTest extends ClientTest
{

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