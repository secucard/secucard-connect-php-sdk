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

    /**
     * Starting/Executing a transaction.
     *
     * @param string $transactionId The transaction id.
     * @param string $type The transaction type like "auto" or "cash".
     * @return Transaction The started transaction.
     */
    public function start($transactionId, $type)
    {
        return $this->execute($transactionId, 'start', $type, null, Transaction::class);
    }

    /**
     * Cancel an existing loyalty transaction.
     * @param string $transactionId The transaction id.
     * @return bool True if successful false else.
     */
    public function cancel($transactionId)
    {
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
        return $this->execute($transactionId, "preTransaction", null, null, LoyaltyBonus::class);
    }
}