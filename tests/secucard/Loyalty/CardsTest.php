<?php

namespace secucard\tests\Loyalty;

use secucard\models\Loyalty\Cards;
use secucard\client\api\Client;

/**
 * @covers secucard\models\Loyalty\Cards
 */
class CardsTest extends \PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        echo 'Test setup running';
        $this->client = new \secucard\client\api\Client(array());

        $this->client->setAuthorization('/app.core.connector/oauth/token', "webapp", "821fc7042ec0ddf5cc70be9abaa5d6d311db04f4679ab56191038cb6f7f9cb7c", "sten@beispiel.net", "secrets");
    }

    public function testGetList()
    {
        $list = $this->client->loyalty->cards->getList(array());

        $this->assertFalse(empty($list));

        // test lazy loading for account
        foreach ($list as $card) {
            if (!empty($card->account)) {
                $this->assertFalse(empty($card->account->id));
                //var_dump($card->account->display_name);
                $tmp = $card->account->display_name;
                $this->assertFalse(empty($tmp));
            }
        }
    }

    public function testGetItem()
    {
        $card = $this->client->loyalty->cards->get('crd_67329');

        $this->assertFalse(empty($card));
    }

}