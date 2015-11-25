<?php

namespace SecucardConnect\Test\Smart;

use SecucardConnect\Test\Api\ClientTest;

/**
 * @covers secucard\models\Smart\Idents
 */
class IdentsTest extends ClientTest
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