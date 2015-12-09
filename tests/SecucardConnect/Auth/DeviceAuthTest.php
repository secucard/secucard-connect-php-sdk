<?php

namespace SecucardConnect\Auth;


use SecucardConnect\BaseClientTest;
use SecucardConnect\Util\Logger;

class DeviceAuthTest extends BaseClientTest
{
    protected function getCredentials()
    {
        return new DeviceCredentials(
            'your-id',
            'your-secret',
            'your-vendor', ['name1' => 'value1']);
    }

    /**
     * Existing tokens must be removed before running the test!
     *
     * @test
     */
    public function testAuth()
    {
        $codes = $this->client->authenticate();

        $this->assertTrue($codes instanceof AuthCodes);

        Logger::logInfo($this->logger, 'User code: ' . $codes->user_code);

        // NOTE:
        // Poll timeout is set to 2 min for test purposes, but normally the timeout is defined by $codes->$expires_in!
        $timeout = time() + 60 * 2;

        do {
            $result = $this->client->authenticate(['devicecode' => $codes->device_code]);
            if ($result === true) {
                break;
            }
            Logger::logInfo($this->logger, 'Auth pending, try again');

            // pause according to the given interval at least
            sleep($codes->interval);

        } while (time() < $timeout);

        $this->assertTrue($result === true);
    }
}