<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Event\DefaultEventHandler;


/**
 * Operations for the payment/secupayprepay resource.
 * @package SecucardConnect\Product\Payment
 */
class SecupayPrepaysService extends ProductService
{
    /**
     * Cancel an existing transaction.
     * @param string $prepayId The prepay id.
     * @param string $contractId The id of the contract that was used to create this transaction. May be null if the
     * contract is an parent contract (not cloned).
     * @return bool True if successful false else.
     */
    public function cancel($prepayId, $contractId = null)
    {
        $o = [['contract' => $contractId]];
        $res = $this->execute($prepayId, 'cancel', null, $o);

	    if(is_object($res)) {
		    return (bool)$res->result;
	    }

        return (bool)$res['result'];
    }

    /**
     * Set a callback to be notified when a prepay has changed. Pass null to remove a previous setting.
     * @param $fn callable|null Any function which accepts a SecupayPrepay class argument.
     *
     */
    public function onSecupayPrepayChanged($fn)
    {
        $this->registerEventHandler('prepaychanged', $fn === null ? null : new PrepayChanged($fn, $this));
    }
}

/**
 * Internal class to handle a debit change event.
 * @package SecucardConnect\Product\Payment
 */
class PrepayChanged extends DefaultEventHandler
{
	/**
	 * @param $event
	 *
	 * @throws ClientError
	 */
    function onEvent($event)
    {
        if (empty($event->data) || count($event->data) == 0) {
            throw new ClientError('Invalid event data, no prepay id found.');
        }
        call_user_func($this->callback, $this->service->get($event->data[0]['id']));
    }
}
