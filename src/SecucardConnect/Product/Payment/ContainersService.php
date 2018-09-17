<?php

namespace SecucardConnect\Product\Payment;

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
     */
    public function getCreditCardContainer(GetCreditCardDataRequest $param)
    {
        return $this->execute('me', 'GetCreditCardContainer', null, $param, BaseCollection::class);
    }
}
