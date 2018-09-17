<?php

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Payment Containers Api Model class
 */
class Container extends BaseModel
{
    const TYPE_BANK_ACCOUNT = "bank_account";

    /**
     * @var Customer
     */
    public $customer;

    /**
     * @var Data
     */
    public $public;

    /**
     * @var Data
     */
    public $private;

    /**
     * @var string
     */
    public $type;

    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var \DateTime
     */
    public $updated;

    /**
     * @var Contract
     */
    public $contract;

    /**
     * @var Mandate
     */
    public $mandate;

    /**
     * @var Checkin
     */
    public $checkin;
}
