<?php
/**
 * Contact Common model class
 */

namespace SecucardConnect\Product\Common\Model;

/**
 * Contact Data Model class
 *
 */
class Contact
{
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
    public $forename;

    /**
     * @var string
     */
    public $surname;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $companyname;

    /**
     * @var \DateTime
     */
    public $dob;

    /**
     * @var string
     */
    public $birthplace;

    /**
     * @var string
     */
    public $nationality;

    /**
     * @var string
     */
    public $gender;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $mobile;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $picture;

    /**
     * @var string
     */
    public $url_website;

    /**
     * @var \SecucardConnect\Product\Common\Model\Address[]
     */
    public $address;
}