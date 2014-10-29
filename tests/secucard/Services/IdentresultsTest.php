<?php

namespace secucard\tests\Services;

use secucard\models\Services\Identresults;
use secucard\tests\Api\ClientTest;

/**
 * @covers secucard\models\Services\Identresults
 */
class IdentresultsTest extends ClientTest
{

    public function testGetList()
    {
        $list = $this->client->services->identresults->getList(array());

        $this->assertFalse(empty($list));

    }

    public function testGetItem()
    {
        $request = $this->client->services->identresults->get('sis_544fcdcc7ba295e7182ce2a1');

        $this->assertFalse(empty($request));
    }

}