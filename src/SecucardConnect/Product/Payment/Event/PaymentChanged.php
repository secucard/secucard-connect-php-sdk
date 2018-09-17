<?php

namespace SecucardConnect\Product\Payment\Event;

use GuzzleHttp\Exception\GuzzleException;
use SecucardConnect\Client\ApiError;
use SecucardConnect\Client\AuthError;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Event\DefaultEventHandler;
use SecucardConnect\Product\General\Model\Event;

/**
 * Internal class to handle a creditcard change event.
 * @package SecucardConnect\Product\Payment
 */
class PaymentChanged extends DefaultEventHandler
{
    /**
     * @param Event $event
     *
     * @throws ClientError If the payment transaction id is missing in the event data
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     */
    function onEvent($event)
    {
        if (!isset($event->data[0]['id'])) {
            throw new ClientError('Invalid event data, payment id not found.');
        }

        call_user_func($this->callback, $this->service->get($event->data[0]['id']));
    }
}
