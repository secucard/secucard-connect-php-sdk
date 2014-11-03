<?php

namespace secucard\tests\Services;

use secucard\models\Services\Identrequests;
use secucard\tests\Api\ClientTest;

/**
 * @covers secucard\models\Services\Identrequests
 */
class IdentrequestsTest extends ClientTest
{

    public function testGetList()
    {
        $list = $this->client->services->identrequests->getList(array());

        $this->assertFalse(empty($list));

    }

    public function testGetItem()
    {
        $request = $this->client->services->identrequests->get('sir_544fc1d37ba2952b7a2ce2a1');

        $this->assertFalse(empty($request));
    }

}