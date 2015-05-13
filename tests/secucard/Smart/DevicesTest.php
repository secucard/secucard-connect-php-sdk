<?php

namespace secucard\tests\Smart;

use secucard\tests\Api\ClientTest;

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