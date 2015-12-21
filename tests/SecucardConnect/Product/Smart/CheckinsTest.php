<?php

namespace SecucardConnect\Product\Smart;

use SecucardConnect\BaseClientTest;

/**
 * @covers secucard\models\Smart\Checkins
 */
class CheckinsTest extends BaseClientTest
{
    /**
     * @test
     */
    public function testGetList()
    {
        $list = $this->client->smart->checkins->getList();

        $this->assertFalse(empty($list));
    }

    /**
     * @test
     */
    public function testGetItem()
    {
        $list = $this->client->smart->checkins->getList(array());

        $this->assertFalse(empty($list) || $list->count() < 1, 'Cannot get any item, because list is empty');
        $sample_item_id = $list[0]->id;
        $this->assertFalse(empty($sample_item_id));

        if ($sample_item_id) {
            $item = $this->client->smart->checkins->get($sample_item_id);

            $this->assertFalse(empty($item));
        }
    }
}