<?php

namespace SecucardConnect\Product\General;

use SecucardConnect\BaseClientTest;
use SecucardConnect\Client\QueryParams;

/**
 * @covers secucard\models\General\Accounts
 */
class AccountsTest extends BaseClientTest
{
    /**
     * @test
     */
    public function testGetList()
    {
        $service = $this->client->general->accounts;
        $query = new QueryParams(3, 2);
        $list = $service->getList($query);
        $this->assertFalse(count($list) == 0);
        $this->assertTrue(count($list) == 3);
        $this->assertTrue(count($list) <= $list->totalCount);
    }

    public function testGetListScroll()
    {
        $service = $this->client->general->accounts;
        $query = new QueryParams(2);
        $list = $service->getScrollableList($query, '1m');
        $this->assertFalse(empty($list->scrollId));
        $this->assertTrue(count($list) == 2);
        $list = $service->getNextBatch($list->scrollId);
        $this->assertFalse(count($list) == 0);
        $this->assertTrue(count($list) == 2);
        $list = $service->getNextBatch($list->scrollId);
        $this->assertFalse(count($list) == 0);
        $this->assertTrue(count($list) == 2);
    }

    /**
     * @test
     */
    public function testGetItem()
    {
        $list = $this->client->general->accounts->getList(new QueryParams(1));

        $this->assertTrue($list->count() == 1);
        $sample_item_id = $list[0]->id;
        $this->assertFalse(empty($sample_item_id), 'Cannot get one item, because none is available');

        if ($sample_item_id) {
            $item = $this->client->general->accounts->get($sample_item_id);

            $this->assertFalse(empty($item));
        }
    }
}
