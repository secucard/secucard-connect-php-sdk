<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * Class AssignedPaymentTransaction
 * @package SecucardConnect\Product\Payment\Model
 */
class AssignedPaymentTransaction extends Transaction
{
    /**
     * The remaining amount of the incoming payment
     * (read only)
     *
     * @var int
     */
    public $remaining_payment_amount;

    /**
     * The remaining (open) amount of the payment transaction
     * (read only)
     *
     * @var int
     */
    public $remaining_transaction_amount;

    /**
     * The remaining amount of the incoming payment before the assigment
     * (read only)
     *
     * @var int
     */
    public $remaining_payment_amount_before;

    /**
     * The remaining (open) amount of the payment transaction before the assigment
     * (read only)
     *
     * @var int
     */
    public $remaining_transaction_amount_before;

    /**
     * @return int
     */
    public function getRemainingPaymentAmount()
    {
        return $this->remaining_payment_amount;
    }

    /**
     * @return int
     */
    public function getRemainingTransactionAmount()
    {
        return $this->remaining_transaction_amount;
    }

    /**
     * @return int
     */
    public function getRemainingPaymentAmountBefore()
    {
        return $this->remaining_payment_amount_before;
    }

    /**
     * @return int
     */
    public function getRemainingTransactionAmountBefore()
    {
        return $this->remaining_transaction_amount_before;
    }
}
