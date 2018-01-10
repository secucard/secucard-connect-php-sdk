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
     * A list of redirect urls used for the payment checkout page
     *
     * @var RedirectUrl
     */
    public $redirect_url;

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