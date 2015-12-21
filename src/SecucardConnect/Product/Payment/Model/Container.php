<?php
/**
 * Payment Containers Api Model class
 */

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Payment Containers Api Model class
 *
 */
class Container extends BaseModel
{
    const TYPE_BANK_ACCOUNT = "bank_account";

    /**
     * @var \SecucardConnect\Product\General\Model\Merchant
     */
    public $merchant;

    /**
     * @var \SecucardConnect\Product\Payment\Model\Data
     */
    public $public;

    /**
     * @var \SecucardConnect\Product\Payment\Model\Data
     */
    public $private;

    /**
     * @var \SecucardConnect\Product\Payment\Model\Customer
     */
    public $assign;

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
     * @var \SecucardConnect\Product\Payment\Model\Contract
     */
    public $contract;
}