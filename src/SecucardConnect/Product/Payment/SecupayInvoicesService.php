<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Event\DefaultEventHandler;


/**
 * Operations for the payment/secupayinvoice resource.
 * @package SecucardConnect\Product\Payment
 */
class SecupayInvoicesService extends ProductService
{
    /**
     * Cancel an existing transaction.
     * @param string $invoiceId The invoice id.
     * @param string $contractId The id of the contract that was used to create this transaction. May be null if the
     * contract is an parent contract (not cloned).
     * @return bool True if successful false else.
     */
    public function cancel($invoiceId, $contractId)
    {
        $o = array(['contract' => $contractId]);
        $res = $this->execute($invoiceId, 'cancel', null, $o);
        return (bool)$res['result'];
    }

    /**
     * Set a callback to be notified when a invoice has changed. Pass null to remove a previous setting.
     * @param $fn callable|null Any function which accepts a SecupayInvoice class argument.
     *
     */
    public function onSecupayInvoiceChanged($fn)
    {
        $this->registerEventHandler('invoicechanged', $fn === null ? null : new InvoiceChanged($fn, $this));
    }
}

/**
 * Internal class to handle a invoice change event.
 * @package SecucardConnect\Product\Payment
 */
class InvoiceChanged extends DefaultEventHandler
{
    function onEvent($event)
    {
        if (empty($event->data) || count($event->data) == 0) {
            throw new ClientError('Invalid event data, no invoice id found.');
        }
        call_user_func($this->callback, $this->service->get($event->data[0]['id']));
    }
}
