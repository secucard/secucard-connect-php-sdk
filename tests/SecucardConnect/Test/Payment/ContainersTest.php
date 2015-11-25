<?php

namespace SecucardConnect\Test\Payment;

use SecucardConnect\Test\Api\ClientTest;

/**
 * @covers secucard\models\Payments\Containers
 */
class ContainersTest extends ClientTest
{
    /**
     * @test
     */
    public function testGetList()
    {
        $list = $this->client->payment->containers->getList();

        $this->assertFalse(empty($list));
    }

    /**
     * @test
     *
    public function testCreation()
    {
        // Dummy Log File
        $fp = fopen('/tmp/secucard_php_test.log', 'a');
        $logger = new \secucard\client\log\Logger($fp, true);

        $container_data = ['type' => 'bank_account',
            'private' => [
                'owner'=> 'John Doe',
                'iban'=> 'correct_iban'
        ]];

        $secucard = $this->client;

        $container = $secucard->factory('Payment\Containers');
        $logger->debug('created object');
        $container->initValues($container_data);
        $logger->debug('object data initialized');
        $success = false;
        try {
            $success = $container->save();
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            $logger->error('Error message: '. $e->getMessage());
            if ($e->hasResponse()) {
                if ($e->getResponse()->getBody()) {
                    $logger->error('Body: ' . json_encode($e->getResponse()->getBody()->__toString()));
                }
            }
        } catch (Exception $e) {
            $logger->error('Error message: '. $e->getMessage());
        }
        $this->assertTrue($success);
        if ($success) {
            $logger->info('Created Object with id: ' . $container->id);
            $logger->info('Object data: ' . $container->as_json());
        }
    }*/
}