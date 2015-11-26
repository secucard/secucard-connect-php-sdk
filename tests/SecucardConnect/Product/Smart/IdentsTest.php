<?php

namespace SecucardConnect\Product\Smart;

use SecucardConnect\BaseClientTest;

/**
 * @covers secucard\models\Smart\Idents
 */
class IdentsTest extends BaseClientTest
{
    /**
     * @test
     */
    public function testGetList()
    {
        $list = $this->client->smart->idents->getList();

        $this->assertFalse(empty($list));
    }

    /**
     * @test
     */
    public function testGetItem()
    {
        // idents does not have method to get one Item
    }
}