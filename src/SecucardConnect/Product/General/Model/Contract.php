<?php

namespace SecucardConnect\Product\General\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Contracts Api Model class
 */
class Contract extends BaseModel
{
    /**
     * @var \SecucardConnect\Product\Payment\Model\Data
     */
    public $pay_in_advance_account;

    /**
     * @var PaymentLinkOptions
     */
    public $payment_link_options;
}
