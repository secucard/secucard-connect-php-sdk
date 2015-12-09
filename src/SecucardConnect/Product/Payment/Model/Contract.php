<?php
/**
 * Payment Contracts Api Model class
 */

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Payment Contracts Api Model class
 *
 */
class Contract extends BaseModel
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
    public $parent;

    /**
     * @var \SecucardConnect\Product\General\Model\Merchant
     */
    public $merchant;

    /**
     * @var boolean
     */
    public $allow_cloning;

    /**
     * @var string
     */
    public $sepa_mandate_inform;
}