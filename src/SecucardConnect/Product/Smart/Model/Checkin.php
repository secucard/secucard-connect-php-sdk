<?php

namespace SecucardConnect\Product\Smart\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Checkin Api Model class
 *
 */
class Checkin extends BaseModel
{
    /**
     * @var string
     */
    public $customerName;

    /**
     * @var string
     */
    public $picture;

    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var \SecucardConnect\Product\General\Model\Account
     */
    public $account;

    /**
     * @var \SecucardConnect\Product\Loyalty\Model\Customer
     */
    public $customer;

    /**
     * @var \SecucardConnect\Product\Loyalty\Model\MerchantCard
     */
    public $merchantcard;

}
