<?php

namespace SecucardConnect\Product\General\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * PaymentMethodsRequestParams Api Model class
 */
class PaymentMethodsRequestParams extends BaseModel
{
    /**
    * PaymentMethodsRequestParams constructor.
    * @param int $is_demo
    * @param string $currency
    */
    public function __construct($is_demo, $currency)
    {
        $this->is_demo = $is_demo;
        $this->currency = $currency;
    }

    /**
    * @var int
    */
    public $is_demo;

    /**
    * @var string
    */
    public $currency;
}
