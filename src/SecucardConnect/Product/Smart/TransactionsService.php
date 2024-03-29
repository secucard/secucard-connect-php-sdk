<?php

namespace SecucardConnect\Product\Smart;


use GuzzleHttp\Exception\GuzzleException;
use SecucardConnect\Client\ApiError;
use SecucardConnect\Client\AuthError;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Product\Smart\Model\Transaction;

/**
 * Class TransactionsService
 * @package SecucardConnect\Product\Smart
 */
class TransactionsService extends ProductService
{

    const TYPE_DEMO = 'demo';
    const TYPE_CASH = 'cash';
    const TYPE_AUTO = 'auto';
    const TYPE_ZVT = 'cashless';
    const TYPE_LOYALTY = 'loyalty';
    const TYPE_DIRECT_DEBIT = 'debit';
    const TYPE_CREDIT_CARD = 'creditcard';
    const TYPE_INVOICE = 'invoice';
    const TYPE_PREPAID = 'prepaid';
    const TYPE_PAYPAL = 'paypal';

    /**
     * Starting/Executing a transaction.
     *
     * @param string $transactionId The transaction id.
     * @param string $type The transaction type like "auto" or "cash".
     * @param null $object
     * @return Transaction The started transaction.
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function start($transactionId, $type, $object = null)
    {
        return $this->execute($transactionId, 'start', $type, $object, Transaction::class);
    }

    /**
     * Preparing a transaction.
     *
     * @param string $transactionId The transaction id.
     * @param string $type The transaction type like "auto" or "cash".
     * @param null $object
     * @return Transaction The prepared transaction.
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function prepare($transactionId, $type, $object = null)
    {
        return $this->execute($transactionId, 'prepare', $type, $object, Transaction::class);
    }

    /**
     * Cancel an existing loyalty transaction.
     * @param string $transactionId The transaction id.
     * @return bool True if successful false else.
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function cancel($transactionId)
    {
        $res = $this->execute($transactionId, 'cancel', null, null, Transaction::class);
        return $res->status === Transaction::STATUS_CANCELLED;
    }

    /**
     * Abort an existing loyalty transaction.
     * @param string $transactionId The transaction id.
     * @return bool True if successful false else.
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function abort($transactionId)
    {
        $res = $this->execute($transactionId, 'abort', null, null, Transaction::class);
        return $res->status === Transaction::STATUS_ABORTED;
    }
}
