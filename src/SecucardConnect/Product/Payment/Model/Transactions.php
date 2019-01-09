<?php

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Common\Model\Contact;
use SecucardConnect\Product\General\Model\Merchant;

/**
 * Class Transactions
 * @package SecucardConnect\Product\Payment\Model
 */
class Transactions extends BaseModel
{
    /**
     * @var Merchant
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
     * @var array
     */
    public $details;

    /**
     * @var Contact
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
