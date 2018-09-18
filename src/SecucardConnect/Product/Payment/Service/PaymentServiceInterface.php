<?php

namespace SecucardConnect\Product\Payment\Service;

/**
 * Interface PaymentServiceInterface
 * @package SecucardConnect\Product\Payment\Service
 */
interface PaymentServiceInterface
{
    /**
     * Cancel an existing transaction.
     * @param string $paymentId The payment transaction id.
     * @param string $contractId The id of the contract that was used to create this transaction. May be null if the
     * contract is an parent contract (not cloned).
     * @return bool True if successful false else.
     */
    public function cancel($paymentId, $contractId = null);


    /**
     * Set a callback to be notified when a payment transaction has changed. Pass NULL to remove a previous setting.
     * @param callable|null $fn Any function which accepts a "Transaction" model class argument.
     */
    public function onStatusChange($fn);

}
