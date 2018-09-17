<?php

namespace SecucardConnect\Product\General;

use SecucardConnect\Client\ProductService;
use SecucardConnect\Product\General\Model\PaymentMethodsRequestParams;

/**
 * Provides operations for General/Contracts product.
 * @package SecucardConnect\Product\General
 */
class ContractsService extends ProductService
{
    /**
     * Retrieves available payment methods for given contract
     *
     * @param PaymentMethodsRequestParams $param
     * @param string $contract_id
     * @return string[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SecucardConnect\Client\ApiError
     * @throws \SecucardConnect\Client\AuthError
     * @throws \SecucardConnect\Client\ClientError
     */
    public function getAvailablePaymentMethods(PaymentMethodsRequestParams $param, $contract_id)
    {
        return $this->execute($contract_id, 'getAvailablePaymentMethods', null, $param);
    }
}
