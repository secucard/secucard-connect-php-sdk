<?php

namespace SecucardConnect\Test\Payment;

use SecucardConnect\Test\Api\ClientTest;

/**
 * @covers secucard\models\Payments\Customers
 */
class CustomersTest extends ClientTest
{
    /**
     * @test
     */
    public function testGetList()
    {
        $list = $this->client->payment->customers->getList();

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

        $contact = [
            'salutation' => 'Mr.',
            'title' => 'Dr.',
            'forename' => 'John',
            'surname' => 'Doe',
            'companyname' => 'Example Inc.',
            'dob' => '1901-02-03',
            'email' => 'example@example.com',
            'phone' => '0049-123-456789',
            'mobile' => '0049-987-654321',
            'address' => [
                'street' => 'Example Street',
                'street_number' => '6a',
                'postal_code' => '01234',
                'city' => 'Examplecity',
                'country' => 'Germany'
        ]];
        $customer_data = ['contact' => $contact,];

        $secucard = $this->client;

        $customer = $secucard->factory('Payment\Customers');
        $logger->debug('created object');
        $customer->initValues($customer_data);
        $logger->debug('object data initialized');
        $success = false;
        try {
            $success = $customer->save();
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
            $logger->info('Created Object with id: ' . $customer->id);
            $logger->info('Object data: ' . $customer->as_json());
        }
    }*/
}