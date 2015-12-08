<?php
/**
 * Address Common model class
 */

namespace SecucardConnect\Product\Common\Model;

/**
 * Address Data Model class
 *
 */
class Address extends BaseModel
{
    /**
     * @var string
     */
    public $street;

    /**
     * @var string
     */
    public $street_number;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $postal_code;

    /**
     * @var string
     */
    public $country;
}