<?php
/**
 * Idents Api Model class
 */

namespace SecucardConnect\Product\Smart\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Loyalty\Model\Customer;
use SecucardConnect\Product\Loyalty\Model\MerchantCard;

/**
 * Idents Api Model class
 *
 */
class Ident extends BaseModel
{
    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $length;

    /**
     * @var string
     */
    public $prefix;

    /**
     * @var string
     */
    public $value;

    /**
     * @var \SecucardConnect\Product\Loyalty\Model\Customer
     */
    public $customer;

    /**
     * @var \SecucardConnect\Product\Loyalty\Model\MerchantCard
     */
    public $merchantcard;

    /**
     * @var boolean
     */
    public $valid;
}