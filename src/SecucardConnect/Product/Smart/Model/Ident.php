<?php
/**
 * Idents Api Model class
 */

namespace SecucardConnect\Product\Smart\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Idents Api Model class
 *
 */
class Ident extends BaseModel
{
    const TYPE_CARD = "card";
    const TYPE_CHECKIN = "checkin";

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