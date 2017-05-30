<?php

namespace SecucardConnect\Product\Services\Model;

/**
 * Company Api Model class
 */
class Company
{
    /**
     * @var string
     */
    public $companyname;

    /**
     * @var string
     */
    public $legal_type;

    /**
     * @var string
     */
    public $register_court;

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
     * @var Address
     */
    public $address;

    /**
     * @var string
     */
    public $url_website;

    /**
     * @var string
     */
    public $tax_id;
}