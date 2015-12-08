<?php

namespace SecucardConnect\Product\Smart;

use SecucardConnect\Auth\RefreshTokenCredentials;
use SecucardConnect\BaseClientTest;

/**
 * @covers secucard\models\Smart\Transactions
 */
class TransactionsTest extends BaseClientTest
{

    protected function getCredentials()
    {
        // smart product uses device auth so either provide valid refresh token here or obtain token by processing
        // the auth flow, see \SecucardConnect\Auth\DeviceAuthTest
        return new RefreshTokenCredentials(
            'your-id',
            'your-secret',
            'your-token');
    }

    /**
     * @test
     */
    public function testGetList()
    {
        $list = $this->client->smart->transactions->getList();

        $this->assertFalse(empty($list));
    }

    /**
     * @test
     */
    public function testGetItem()
    {
        $list = $this->client->smart->transactions->getList(array());

        $this->assertFalse(empty($list) || $list->count() < 1, 'Cannot get any item, because list is empty');
        $sample_item_id = $list[0]->id;
        $this->assertFalse(empty($sample_item_id));

        if ($sample_item_id) {
            $item = $this->client->smart->transactions->get($sample_item_id);

            $this->assertFalse(empty($item));
        }
    }
}