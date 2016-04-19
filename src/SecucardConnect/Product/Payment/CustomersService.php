<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\Client\ProductService;
use SecucardConnect\Client\RequestOptions;
use SecucardConnect\Event\AbstractEventHandler;
use SecucardConnect\Product\Common\Model\BaseCollection;
use SecucardConnect\Product\General\Model\Event;
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
        $this->registerEventHandler('h2k0sh6lm1w',
            $fn === null ? null : new CustChange($this->resourceMetadata->resourceId, Event::TYPE_CHANGED, $fn, $this));
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
class CustChange extends AbstractEventHandler
{
    /**
     * @var CustomersService
     */
    private $service;

    /**
     * CustomerChangedHandler constructor.
     * @param null|string $eventTarget
     * @param null|string $eventType
     * @param callable $callback
     * @param $service CustomersService
     */
    public function __construct($eventTarget, $eventType, callable $callback, $service)
    {
        parent::__construct($eventTarget, $eventType, $callback);
        $this->service = $service;
    }

    function handle($event)
    {
        if ($this->accept($event)) {
            if (!empty($event->data) && count($event->data) != 0) {
                call_user_func($this->callback, $this->service->get($event->data[0]['id']));
            }
            return true;
        }

        return false;
    }
}


