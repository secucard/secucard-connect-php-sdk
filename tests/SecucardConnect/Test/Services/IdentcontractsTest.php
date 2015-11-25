<?php

namespace SecucardConnect\Test\Services;

use SecucardConnect\Test\Api\ClientTest;

/**
 * @covers Identcontracts
 */
class IdentcontractsTest extends ClientTest
{
    /**
     * @test
     */
    public function testGetList()
    {
        $list = $this->client->services->identcontracts->getList();

        $this->assertFalse(empty($list));
    }
}