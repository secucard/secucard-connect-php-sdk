<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Event\DefaultEventHandler;


/**
 * Operations for the payment/secupaydebits resource.
 * @package SecucardConnect\Product\Payment
 */
class SecupayDebitsService extends ProductService
{
    /**
     * Cancel an existing transaction.
     * @param string $debitId The debit id.
     * @param string $contractId The id of the contract that was used to create this transaction. May be null if the
     * contract is an parent contract (not cloned).
     * @return bool True if successful false else.
     */
    public function cancel($debitId, $contractId)
    {
        $o = array(['contract' => $contractId]);
        $res = $this->execute($debitId, 'cancel', null, $o);
        return (bool)$res['result'];
    }

    /**
     * Set a callback to be notified when a debit has changed. Pass null to remove a previous setting.
     * @param $fn callable|null Any function which accepts a SecupayDebit class argument.
     *
     */
    public function onSecupayDebitChanged($fn)
    {
        $this->registerEventHandler('debitchanged', $fn === null ? null : new DebitChanged($fn, $this));
    }
}

/**
 * Internal class to handle a debit change event.
 * @package SecucardConnect\Product\Payment
 */
class DebitChanged extends DefaultEventHandler
{
    function onEvent($event)
    {
        if (empty($event->data) || count($event->data) == 0) {
            throw new ClientError('Invalid event data, no debit id found.');
        }
        call_user_func($this->callback, $this->service->get($event->data[0]['id']));
    }
}
