<?php

namespace SecucardConnect\Product\Payment\Model;

class GetCreditCardDataRequest
{
    /**
     * @var \SecucardConnect\Product\Payment\Model\Checkin
     */
    public $checkin;

    /**
     * @var \SecucardConnect\Product\Payment\Model\Customer
     */
    public $customer;

    /**
     * @var string
     */
    public $transact_hash;
}