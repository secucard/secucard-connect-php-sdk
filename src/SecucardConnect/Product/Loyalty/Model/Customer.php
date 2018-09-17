<?php

namespace SecucardConnect\Product\Loyalty\Model;


use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Class Customer
 * @package SecucardConnect\Product\Loyalty\Model
 */
class Customer extends BaseModel
{
    /**
     * @var \SecucardConnect\Product\General\Model\Merchant
     */
    public $merchant;

    /**
     * @var \SecucardConnect\Product\Common\Model\Contact
     */
    public $contact;

    /**
     * @var string
     */
    public $forename;

    /**
     * @var string
     */
    public $surname;

    /**
     * @var string
     */
    public $company;

    /**
     * @var string
     */
    public $display_name;

    /**
     * @var string
     */
    public $salutation;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $street;

    /**
     * @var string
     */
    public $zipcode;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $fax;

    /**
     * @var string
     */
    public $mobile;

    /**
     * @var string
     */
    public $note;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $age;

    /**
     * @var string
     */
    public $days_until_birthday;

    /**
     * @var string[]
     */
    public $additional_data;

    /**
     * @var string
     */
    public $customer_number;

    /**
     * @var \DateTime
     */
    public $dob;

    /**
     * @var string
     */
    public $picture;

//public MediaResource pictureObject;

}
