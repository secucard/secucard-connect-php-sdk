<?php

namespace secucard\tests\Payments;

use secucard\tests\Api\ClientTest;

/**
 * @covers secucard\models\Payments\Secupayprepays
 */
class SecupayprepaysTest extends ClientTest
{
    /**
     * @test
     *
    public function testGetList()
    {
        $id = 'todo_fill_real_id';
        $object = $this->client->payment->Secupayprepays->get($id);

        $this->assertFalse(empty($object));
    }

    /**
     * @test
     *
    public function testCreation()
    {
        $fp = fopen('/tmp/secucard_php_test.log', 'a');
        $logger = new \secucard\client\log\Logger($fp, true);

        $prepay_data = [
            'customer' => [
                'object' => 'payment.customers',
                'id' => 'PCU_WJG973MWA2YAUT49R5GQGJSZR3YNAA'
            ],
            'contract' => [
                'object' => 'payment.contracts',
                'id' => 'PCR_GNCNSQ4TR2YBX74Y7N8KYFYW8PUKAG',
            ],
            'amount' => '100',
            'currency' => 'EUR',
            'purpose' => 'for what text',
            'order_id' => 'ZZZZZZ'
        ];

        $secucard = $this->client;

        $object = $secucard->factory('Payment\Secupayprepays');
        $logger->debug('created object');
        $object->initValues($prepay_data);
        $logger->debug('object data initialized');
        $success = false;
        try {
            $success = $object->save();
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
            $logger->info('Created Object with id: ' . $object->id);
            $logger->info('Object data: ' . $object->as_json());
        }
    }/**/
}