<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\BaseClientTest;

/**
 * @covers secucard\models\Payments\Contracts
 */
class ContractsTest extends BaseClientTest
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