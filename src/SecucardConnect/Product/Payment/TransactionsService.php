<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\Client\ClientContext;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Client\ResourceMetadata;

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

    public function getCrowdFundingData($merchantId)
    {
        return $this->getWithAction("", 'crowdfundingdata', $merchantId);
    }
}
