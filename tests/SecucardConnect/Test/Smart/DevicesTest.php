<?php

namespace SecucardConnect\Test\Smart;

use SecucardConnect\Test\Api\ClientTest;

/**
 * @covers secucard\models\Smart\Devices
 */
class DevicesTest extends ClientTest
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