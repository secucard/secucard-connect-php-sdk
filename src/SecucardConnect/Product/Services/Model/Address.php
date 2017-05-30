<?php

namespace SecucardConnect\Product\Services\Model;

use SecucardConnect\Product\Common\Model\Location;

/**
 * Address Api Model class
 */
class Address
{
    /**
     * @var AddressComponents[]
     */
    public $address_components;

    /**
     * @var string
     */
    public $address_formatted;

    /**
     * @var Location
     */
    public $geometry;
}