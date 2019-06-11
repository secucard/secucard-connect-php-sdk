<?php
/**
 * Stores Api Model class
 */

namespace SecucardConnect\Product\General\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Stores Api Model class
 *
 */
class Store extends BaseModel
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $address_formatted;
}