<?php
/**
 * Checkin Api Model class
 */

namespace SecucardConnect\Product\Smart\Model;

use DateTime;
use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\General\Model\Account;
use SecucardConnect\Product\Loyalty\Model\Customer;
use SecucardConnect\Product\Loyalty\Model\MerchantCard;

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