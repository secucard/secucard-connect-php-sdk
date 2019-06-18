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
    public $item_type = self::ITEM_TYPE_TRANSACTION_PAYOUT;

    /**
     * The payment ID of the origin transaction
     *
     * @var string
     */
    public $transaction_hash;

    /**
     * The payment transaction ID of the origin transaction
     *
     * @var string
     */
    public $transaction_id;

    /**
     * Payment Container ID (as alternative to the origin transaction)
     *
     * @var string
     */
    public $container_id;

    /**
     * Reference id - must be unique for the entire basket
     *
     * @var string
     */
    public $reference_id;
}
