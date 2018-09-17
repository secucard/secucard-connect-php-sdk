<?php

namespace SecucardConnect\Product\Smart;

use SecucardConnect\Client\ProductService;
use SecucardConnect\Product\Smart\Model\Transaction;
use SecucardConnect\Product\Loyalty\Model\LoyaltyBonus;

class TransactionsService extends ProductService
{
    const TYPE_DEMO = "demo";
    const TYPE_CASH = "cash";
    const TYPE_AUTO = "auto";
    const TYPE_ZVT = "cashless";
    const TYPE_LOYALTY = "loyalty";
    const TYPE_DIRECT_DEBIT = "debit";
    const TYPE_CREDIT_CARD = "creditcard";

    /**
     * Starting/Executing a transaction.
     *
     * @param string $transactionId Id of the smart transaction
     * @param string $type The transaction type like "cashless" or "cash".
     * @return Transaction The started transaction.
     */
    public function start($transactionId, $type, $object = null)
    {
        if (empty($transactionId)) {
            throw new \InvalidArgumentException("Parameter [transactionId] can not be empty!");
        }

        if (empty($type)) {
            throw new \InvalidArgumentException("Parameter [type] can not be empty!");
        }

        if (!in_array($type, [self::TYPE_DEMO, self::TYPE_CASH, self::TYPE_AUTO, self::TYPE_ZVT, self::TYPE_LOYALTY])) {
            throw new \InvalidArgumentException("Wrong transaction type");
        }

        return $this->execute($transactionId, 'start', $type, $object, Transaction::class);
    }

    /**
     * Preparing a transaction.
     *
     * @param string $transactionId The transaction id.
     * @param string $type The transaction type like "auto" or "cash".
     * @return Transaction The prepared transaction.
     */
    public function prepare($transactionId, $type, $object = null)
    {
        if (!in_array($type, [self::TYPE_AUTO, self::TYPE_DIRECT_DEBIT, self::TYPE_CREDIT_CARD])) {
            throw new \InvalidArgumentException("Wrong transaction type");
        }

        return $this->execute($transactionId, 'prepare', $type, $object, Transaction::class);
    }

    /**
     * Cancel an existing loyalty transaction.
     * @param string $transactionId Id of the smart transaction
     * @return bool True if successful false else.
     */
    public function cancel($transactionId)
    {
        if (empty($transactionId)) {
            throw new \InvalidArgumentException("Parameter [transactionId] can not be empty!");
        }

        $res = $this->execute($transactionId, 'cancel', null, 'array');
        return (bool)$res['result'];
    }

    /**
     * Request loyalty bonus products and add them to the basket
     * @param string $transactionId Id of the smart transaction
     * @return LoyaltyBonus
     */
    public function appendLoyaltyBonusProducts($transactionId)
    {
        if (empty($transactionId)) {
            throw new \InvalidArgumentException("Parameter [transactionId] can not be empty!");
        }

        return $this->execute($transactionId, "preTransaction", null, null, LoyaltyBonus::class);
    }
}