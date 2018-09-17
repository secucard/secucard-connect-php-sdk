<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * Class GetCreditCardDataRequest
 * @package SecucardConnect\Product\Payment\Model
 */
class GetCreditCardDataRequest
{
    /**
     * @var Checkin
     */
    public $checkin;

    /**
     * @var Customer
     */
    public $customer;

    /**
     * @var string
     */
    public $transact_hash;
}
