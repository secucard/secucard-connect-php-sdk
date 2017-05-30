<?php

namespace SecucardConnect\Product\Services\Model;

/**
 * Contact Api Model class
 */
class Contact
{
    /**
     * @var integer
     */
    public $share;

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
    public $role;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $email;

    /**
     * @var Address
     */
    public $address;
}