<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\Client\ProductService;
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
     * @return bool|mixed|null|string
     */
    public function getCreditCardContainer(GetCreditCardDataRequest $param)
    {
        return $this->execute('me', 'CreditCardContainer', null, $param, GetCreditCardDataRequest::class);
    }
}
