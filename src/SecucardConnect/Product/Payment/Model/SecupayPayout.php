<?php

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Payment SecupayPayout Api Model class
 *
 */
class SecupayPayout extends BaseModel
{
    /**
     * Create a demo transaction
     *
     * @var bool
     */
    public $demo;

    /**
     * 	Total amount of transaction lit's items
     *
     * @var int
     */
    public $amount;

    /**
     * ISO 4217 code of currency, eg EUR for Euro.
     *
     * @var string
     */
    public $currency;

    /**
     * The purpose of the payment.
     *
     * @var string
     */
    public $purpose;

    /**
     * Transaction ID
     * [read-only]
     *
     * @var string
     */
    public $trans_id;

    /**
     * @var string
     */
    public $status;

    /**
     * Contract ID
     *
     * @var string
     */
    public $contract;

    /**
     * Payment customer ID
     *
     * @var string
     */
    public $customer;

    /**
     * Specifying an order number.
     *
     * @var string
     */
    public $order_id;

    /**
     * Transaction status ID
     * [read-only]
     *
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
     * A list of redirect urls used for the payment checkout page
     *
     * @var RedirectUrl
     */
    public $redirect_url;

    /**
     * The reference to be used for the transfer
     * [read-only]
     *
     * @var string
     */
    public $transfer_purpose;

    /**
     * Bank details to be used for the transfer
     * [read-only]
     *
     * @var TransferAccount
     */
    public $transfer_account;
}
