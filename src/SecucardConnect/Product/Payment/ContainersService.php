<?php

namespace SecucardConnect\Product\Payment;

use GuzzleHttp\Exception\GuzzleException;
use SecucardConnect\Client\ApiError;
use SecucardConnect\Client\AuthError;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Product\Common\Model\BaseCollection;
use SecucardConnect\Product\Payment\Model\GetCreditCardDataRequest;


/**
 * Operations for the payment/containers resource.
 * @package SecucardConnect\Product\Payment
 */
class ContainersService extends ProductService
{
    /**
     * Gets data of credit card container. Should be used to check, if given container already exists.
     *
     * @param GetCreditCardDataRequest $param
     * @return BaseCollection
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function getCreditCardContainer(GetCreditCardDataRequest $param)
    {
        return $this->execute('me', 'GetCreditCardContainer', null, $param, BaseCollection::class);
    }
}
