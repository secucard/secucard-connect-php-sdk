<?php
/**
 * Contactaddress Common model class
 */

namespace SecucardConnect\Product\Common\Model;

/**
 * ContactAddress Data Model class
 *
 */
class ContactAddress extends BaseModel
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