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
     * @var \SecucardConnect\Product\Payment\Model\Contract
     */
    public $contract;

    /**
     * @var \SecucardConnect\Product\Common\Model\Contact
     */
    public $contact;

    /**
     * @var \SecucardConnect\Product\General\Model\Merchant
     */
    public $merchant;
}