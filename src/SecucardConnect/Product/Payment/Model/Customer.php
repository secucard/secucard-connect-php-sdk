<?php
/**
 * Payment Customers Api Model class
 */

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Payment Customers Api Model class
 *
 */
class Customer extends BaseModel
{
    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var \DateTime
     */
    public $updated;

    /**
     * @var \SecucardConnect\Product\Common\Model\Contact
     */
    public $contact;

    /**
     * @var string
     */
    public $merchant_id;

    /**
     * @var \SecucardConnect\Product\General\Model\Merchant
     */
    public $merchant;

    /**
     * @var \SecucardConnect\Product\Payment\Model\Checkin
     */
    public $checkin;

    /**
     * Your ID of the customer
     * @var int
     */
    public $merchant_customer_id;
}
