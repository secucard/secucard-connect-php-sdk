<?php

namespace SecucardConnect\Product\General\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * CheckoutOptions Api Model class
 */
class CheckoutOptions extends BaseModel
{
    /**
     * @var boolean
     */
    public $enabled;

    /**
     * @var array
     */
    public $background_image;

    /**
     * @var array
     */
    public $shipping;

    /**
     * @var array
     */
    public $collection;
}

