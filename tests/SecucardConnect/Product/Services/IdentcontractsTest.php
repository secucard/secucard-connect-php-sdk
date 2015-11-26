<?php

namespace SecucardConnect\Product\Services;

use SecucardConnect\BaseClientTest;

/**
 * @covers Identcontracts
 */
class IdentcontractsTest extends BaseClientTest
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