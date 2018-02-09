<?php
/**
 * Merchants Api Model class
 */

namespace SecucardConnect\Product\General\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Merchants Api Model class
 *
 */
class CheckoutOptions extends BaseModel
{
    /**
     * @var bool
     */
    public $enabled;

    /**
     * @var OrderOption[]
     */
    public $order_options;
}