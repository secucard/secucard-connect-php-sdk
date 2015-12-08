<?php

namespace SecucardConnect\Product\Loyalty\Model;


use SecucardConnect\Product\Common\Model\BaseModel;

class MerchantCard extends BaseModel
{
    /**
     * @var \SecucardConnect\Product\General\Model\Merchant
     */
    public $merchant;

    /**
     * @var \SecucardConnect\Product\General\Model\Merchant
     */
    public $created_for_merchant;

    /**
     * @var \SecucardConnect\Product\General\Model\Store
     */
    public $created_for_store;

    /**
     * @var \SecucardConnect\Product\Loyalty\Model\Card
     */
    public $card;

    /**
     * @var boolean
     */
    public $is_base_card;

    /**
     * @var \SecucardConnect\Product\Loyalty\Model\CardGroup
     */
    public $cardgroup;

    /**
     * @var \SecucardConnect\Product\Loyalty\Model\Customer
     */
    public $customer;

    /**
     * @var int
     */
    public $balance;

    /**
     * @var int
     */
    public $points;

    /**
     * @var \DateTime
     */
    public $last_usage;

    /**
     * @var \DateTime
     */
    public $last_charge;

    /**
     * @var string
     */
    public $stock_status;

    /**
     * @var string
     */
    public $lock_status;
}