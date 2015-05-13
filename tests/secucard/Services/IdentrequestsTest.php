<?php

namespace secucard\tests\Services;

use secucard\tests\Api\ClientTest;

/**
 * @covers secucard\models\Services\Identrequests
 */
class IdentrequestsTest extends ClientTest
{
    /**
     * @test
     */
    public function testGetList()
    {
        $list = $this->client->services->identrequests->getList(array());

        $this->assertFalse(empty($list));
    }

    /**
     * @test
     */
    public function testGetItem()
    {
        $list = $this->client->services->identrequests->getList(array('count'=>1));

        $this->assertFalse(empty($list), 'Cannot get any item, because list is empty');
        $sample_item_id = $list[0]->id;
        $this->assertFalse(empty($sample_item_id));

        if ($sample_item_id) {
            $item = $this->client->services->identrequests->get($sample_item_id);

            $this->assertFalse(empty($item));
        }
    }

    /**
     * @test
     */
    public function testGetAllItemsForListCount()
    {
        $list = $this->client->services->identrequests->getList(array());

        $this->assertFalse(empty($list));

        $i = 0;
        foreach ($list as $item) {
            $this->client->logger->info('Item: ' . ($i + 1) . ': ' . $item->id);
            $i++;
        }
    }
}