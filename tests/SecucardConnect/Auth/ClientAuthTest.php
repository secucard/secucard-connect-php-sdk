<?php

namespace SecucardConnect\Auth;


use SecucardConnect\BaseClientTest;

class ClientAuthTest extends BaseClientTest
{
    /**
     * @test
     */
    public function testAuth()
    {
        $result = $this->client->authenticate();
        $this->assertTrue($result === true);
    }
}