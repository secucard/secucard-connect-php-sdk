<?php

namespace SecucardConnect\Product\Services;

use SecucardConnect\BaseClientTest;
use SecucardConnect\Client\QueryParams;

/**
 * @covers secucard\models\Services\Identrequests
 */
class IdentrequestsTest extends BaseClientTest
{
    /**
     * @test
     */
    public function testGetList()
    {
        $list = $this->client->services->identrequests->getList();

        $this->assertFalse(empty($list));
    }

    /**
     * @test
     */
    public function testGetItem()
    {
        $list = $this->client->services->identrequests->getList(new QueryParams(1));

        $this->assertFalse(empty($list), 'Cannot get any item, because list is empty');
        $sample_item_id = $list->items[0]->id;
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
        $list = $this->client->services->identrequests->getList();

        $this->assertFalse(empty($list));

        $i = 0;
        foreach ($list as $item) {
            $this->client->logger->info('Item: ' . ($i + 1) . ': ' . $item->id);
            $i++;
        }
    }
}