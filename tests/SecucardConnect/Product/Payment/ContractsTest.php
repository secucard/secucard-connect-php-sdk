<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\BaseClientTest;
use SecucardConnect\Product\Payment\Model\CloneParams;
use SecucardConnect\Product\Payment\Model\Data;

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

    public function testClone()
    {
        $params = new CloneParams('project', new Data('iban'), false);

        $contr = $this->client->payment->contracts->cloneMyContract($params);

        $this->assertNotNull($contr);
    }
}
