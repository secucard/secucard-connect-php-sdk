<?php

namespace SecucardConnect\Product\Services\Model;

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
     * @var \SecucardConnect\Product\Common\Model\Location
     */
    public $geometry;
}