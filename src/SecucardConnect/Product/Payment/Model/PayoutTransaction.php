<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * Basket Data Model class
 *
 */
class PayoutTransaction
{
    const ITEM_TYPE_TRANSACTION_PAYOUT = 'transaction_payout';

    /**
     * The purpose of this specific payout transaction
     * (limited to 160 characters)
     *
     * @var string
     */
    public $name;

    /**
     * The amount to be transferred for this transaction
     *
     * @var int
     */
    public $total;

    /**
     * Type of this item
     * (currently only 'transaction_payout' allowed)
     *
     * @var string
     */
    public $item_type = 'transaction_payout';

    /**
     * The payment id of the origin transaction
     *
     * @var string
     */
    public $transaction_hash;
}