<?php

namespace secucard\tests\Services;

use secucard\models\Services\Identresults;
use secucard\tests\Api\ClientTest;

/**
 * @covers secucard\models\Services\Identresults
 */
class IdentresultsTest extends ClientTest
{
    /**
     * @test
     */
    public function testGetList()
    {
        $list = $this->client->services->identresults->getList(array());

        $this->assertFalse(empty($list));
    }

    /**
     * @test
     */
    public function testGetItem()
    {
        $list = $this->client->services->identresults->getList(array());

        $this->assertFalse(empty($list), 'Cannot get any item, because list is empty');
        $sample_item_id = $list[0]->id;
        $this->assertFalse(empty($sample_item_id));

        if ($sample_item_id) {
            $item = $this->client->services->identresults->get($sample_item_id);

            $this->assertFalse(empty($item));
        }
    }
}