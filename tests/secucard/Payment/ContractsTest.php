<?php

namespace secucard\tests\Payments;

use secucard\tests\Api\ClientTest;

/**
 * @covers secucard\models\Payments\Contracts
 */
class ContractsTest extends ClientTest
{
    /**
     * @test
     */
    public function testGetList()
    {
        $list = $this->client->payment->contracts->getList();

        $this->assertFalse(empty($list));
    }
}