<?php

namespace SecucardConnect\Test\Payment;

use SecucardConnect\Test\Api\ClientTest;

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