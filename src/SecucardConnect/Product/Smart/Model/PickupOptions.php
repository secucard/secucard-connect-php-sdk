<?php
/**
 * PickupOptions Api Model class
 */

namespace SecucardConnect\Product\Smart\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * PickupOptions Api Model class
 *
 */
class PickupOptions extends BaseModel
{
    /**
     * @var int
     */
    public $code;

    /**
     * @var \DateTime
     */
    public $date;
}