<?php

namespace SecucardConnect\Test\Loyalty;

use SecucardConnect\Test\Api\ClientTest;

/**
 * @covers secucard\models\Loyalty\Cards
 */
class CardsTest extends ClientTest
{
    /**
     * @test
     */
    public function testGetList()
    {
        $list = $this->client->loyalty->cards->getList(array());

        $this->assertFalse(empty($list), 'Card list empty');

        // test lazy loading for account
        $temp_account = null;
        $count = 0;
        foreach ($list as $card) {
            // do not load all the cards available
            if ($count > 20) {
                break;
            }
            if (!empty($card->account)) {
                $this->assertFalse(empty($card->account->id));

                // it is needed for lazy loading to copy the loading property to some temporary variable
                $tmp = $card->account->display_name;
                $temp_account = $card->account;
                $this->assertFalse(empty($card->account->display_name));
            }
            $count++;
        }
    }

    /**
     * @test
     */
    public function testGetItem()
    {
        $list = $this->client->loyalty->cards->getList(array('count'=>1));

        $this->assertFalse(empty($list));
        $sample_item_id = $list[0]->id;
        $this->assertFalse(empty($sample_item_id), 'Cannot get one item, because none is available');

        if ($sample_item_id) {
            $item = $this->client->loyalty->cards->get($sample_item_id);

            $this->assertFalse(empty($item));
        }
    }
}