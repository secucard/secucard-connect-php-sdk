<?php

namespace SecucardConnect\Product\Payment\Event;

use SecucardConnect\Client\ClientError;
use SecucardConnect\Event\DefaultEventHandler;

/**
 * Internal class to handle a creditcard change event.
 * @package SecucardConnect\Product\Payment
 */
class PaymentChanged extends DefaultEventHandler
{
    /**
     * @param $event
     *
     * @throws ClientError If the payment transaction id is missing in the event data
     */
    function onEvent($event)
    {
        if (!isset($event->data[0]['id'])) {
            throw new ClientError('Invalid event data, payment id not found.');
        }

        call_user_func($this->callback, $this->service->get($event->data[0]['id']));
    }
}