<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\Client\ProductService;
use SecucardConnect\Client\RequestOptions;
use SecucardConnect\Product\Common\Model\BaseCollection;
use SecucardConnect\Product\Payment\Model\Customer;


/**
 * Operations for the payment/customers resource.
 * @package SecucardConnect\Product\Payment
 */
class CustomersService extends ProductService
{
    /**
     * {@inheritDoc}
     */
    protected function getRequestOptions()
    {
        return [
            RequestOptions::RESULT_PROCESSING => function (&$value) {
                if ($value instanceof BaseCollection) {
                    $results = $value->items;
                } elseif ($value instanceof Customer) {
                    $results = [$value];
                } else {
                    return;
                }

                foreach ($results as $result) {
                    $this->process($result);
                }
            }
        ];
    }

    /**
     * Handles proper picture object initialization after retrieval of a customer.
     * @param Customer $customer
     */
    private function process(Customer &$customer)
    {
        if (isset($customer->contact) && isset($customer->contact->picture)) {
            $customer->contact->pictureObject = $this->initMediaResource($customer->contact->picture);
        }
    }
}
