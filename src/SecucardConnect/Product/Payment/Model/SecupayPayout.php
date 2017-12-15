<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * Payment SecupayPayouts Api Model class
 *
 */
class SecupayPayout extends Transaction
{
    /**
     * @var int
     */
    public $amount;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var string
     */
    public $purpose;

    /**
     * @var string
     */
    public $trans_id;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $transaction_status;

    /**
     * A list of transactions to payout
     * (maximum 200 items can be transferred at the same time)
     *
     * @var PayoutTransaction[]
     */
    public $transaction_list;

    /**
     * The reference to be used for the transfer
     *
     * @var string
     */
    public $transfer_purpose;

    /**
     * Bank details to be used for the transfer
     *
     * @var TransferAccount
     */
    public $transfer_account;
}