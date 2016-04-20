<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Client\RequestOptions;
use SecucardConnect\Event\DefaultEventHandler;
use SecucardConnect\Product\Common\Model\BaseCollection;
use SecucardConnect\Product\Payment\Model\Customer;


/**
 * Operations for the payment/customers resource.
 * @package SecucardConnect\Product\Payment
 */
class CustomersService extends ProductService
{
    /**
     * Set a callback to be notified when a customer has changed. Pass null to remove a previous setting.
     * @param $fn callable|null Any function which accepts a Customer class argument.
     *
     */
    public function onCustomerChanged($fn)
    {
        $this->registerEventHandler('paymentcustchanged', $fn === null ? null : new CustChanged($fn, $this));
    }

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
                    $results[] = $value;
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

/**
 * Internal class to handle a customer change event.
 * @package SecucardConnect\Product\Payment
 */
class CustChanged extends DefaultEventHandler
{
    function onEvent($event)
    {
        if (empty($event->data) || count($event->data) == 0) {
            throw new ClientError('Invalid event data, no customer id found.');
        }
        call_user_func($this->callback, $this->service->get($event->data[0]['id']));
    }
}


