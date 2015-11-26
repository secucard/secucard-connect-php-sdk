<?php

namespace SecucardConnect\Product\Smart;

use SecucardConnect\BaseClientTest;

/**
 * @covers secucard\models\Smart\Devices
 */
class DevicesTest extends BaseClientTest
{
    /**
     * @test
     */
    public function testGetList()
    {
        $list = $this->client->smart->devices->getList();

        $this->assertFalse(empty($list));
    }

}