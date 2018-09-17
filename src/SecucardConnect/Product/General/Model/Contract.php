<?php
/**
 * Stores Api Model class
 */

namespace SecucardConnect\Product\General\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Contracts Api Model class
 *
 */
class Contract extends BaseModel
{
    /**
     * @var \SecucardConnect\Product\Payment\Model\Data
     */
    public $pay_in_advance_account;
}