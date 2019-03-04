<?php

namespace SecucardConnect\Product\Payment;

use GuzzleHttp\Exception\GuzzleException;
use SecucardConnect\Client\ApiError;
use SecucardConnect\Client\AuthError;
use SecucardConnect\Client\ClientContext;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Client\ResourceMetadata;
use SecucardConnect\Product\Payment\Model\AssignedPaymentTransaction;
use SecucardConnect\Product\Payment\Model\CrowdFundingData;

/**
 * Operations for the payment.transactions resource.
 * @package SecucardConnect\Product\Payment
 */
class TransactionsService extends ProductService
{
    /**
     * @inheritdoc
     */
    public function __construct(ResourceMetadata $resourceMetadata = null, ClientContext $context = null)
    {
        parent::__construct($resourceMetadata, $context);
        $this->resourceMetadata->resourceClass = 'SecucardConnect\\Product\\Payment\\Model\\Transactions';
    }

    /**
     * @param string $merchantId ('MRC_...')
     * @return CrowdFundingData
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     */
    public function getCrowdFundingData($merchantId)
    {
        return $this->getWithAction(
            'not_set',
            'crowdfundingdata',
            $merchantId,
            null,
            'SecucardConnect\\Product\\Payment\\Model\\CrowdFundingData'
        );
    }

    /**
     * Assign a incoming payment to a (prepay) payment transaction
     *
     * @param string $paymentId The payment transaction id ('PCI_...' or 'abcdefghijkz123456')
     * @param int $accountingId
     * @return AssignedPaymentTransaction
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function assignPayment($paymentId, $accountingId)
    {
        return $this->execute(
            $paymentId,
            'assignPayment',
            $accountingId,
            null,
            'SecucardConnect\\Product\\Payment\\Model\\AssignedPaymentTransaction'
        );
    }
}
