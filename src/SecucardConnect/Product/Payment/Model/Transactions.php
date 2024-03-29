<?php
/** @noinspection PhpUnused */

namespace SecucardConnect\Product\Payment\Model;

/**
 * Class Transactions
 * @package SecucardConnect\Product\Payment\Model
 */
class Transactions extends Transaction
{
    /**
     * @var \SecucardConnect\Product\General\Model\Merchant
     */
    public $merchant;

    /**
     * @var int
     */
    public $trans_id;

    /**
     * @var int
     */
    public $product_id;

    /**
     * @var string
     */
    public $product;

    /**
     * @var string
     */
    public $product_raw;

    /**
     * @var int
     */
    public $zahlungsmittel_id;

    /**
     * @var int
     */
    public $contract_id;

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
    public $created;

    /**
     * @var string
     */
    public $updated;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $description_raw;

    /**
     * @var int
     */
    public $status;

    /**
     * @var string
     */
    public $status_text;

    /**
     * @var TransactionsDetails
     */
    public $details;

    /**
     * @var \SecucardConnect\Product\Common\Model\Contact
     */
    public $customer;

    /**
     * @var string
     */
    public $incoming_payment_date;

    /**
     * @var string
     */
    public $payout_date;
}
