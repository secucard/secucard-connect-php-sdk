<?php

namespace secucard\tests\Services;

use secucard\tests\Api\ClientTest;

/**
 * @covers secucard\models\Services\Identcontracts
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