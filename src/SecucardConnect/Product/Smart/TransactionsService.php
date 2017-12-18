<?php

namespace SecucardConnect\Product\Smart;


use SecucardConnect\Client\ProductService;
use SecucardConnect\Product\Smart\Model\Transaction;

class TransactionsService extends ProductService
{

    const TYPE_DEMO = "demo";
    const TYPE_CASH = "cash";
    const TYPE_AUTO = "auto";
    const TYPE_ZVT = "cashless";
    const TYPE_LOYALTY = "loyalty";
    const TYPE_DIRECT_DEBIT = "direct_debit";

    /**
     * Starting/Executing a transaction.
     *
     * @param string $transactionId The transaction id.
     * @param string $type The transaction type like "auto" or "cash".
     * @return Transaction The started transaction.
     */
    public function start($transactionId, $type, $object = null)
    {
        return $this->execute($transactionId, 'start', $type, $object, Transaction::class);
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
}