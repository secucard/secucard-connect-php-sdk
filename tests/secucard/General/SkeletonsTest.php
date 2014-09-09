<?php

namespace secucard\tests\General;

use secucard\models\General\Skeletons;
use secucard\tests\Api\ClientTest;

/**
 * @covers secucard\models\General\Skeletons
 */
class SkeletonsTest extends ClientTest
{

    public function testGetList()
    {
        $list = $this->client->general->skeletons->getList(array());

        $this->assertFalse(empty($list));
    }

    public function testGetItem()
    {
        $skeleton = 'not implemented yet';//$this->client->general->skeletons->get(1);

        $this->assertFalse(empty($skeleton));
    }

}