<?php
/**
 * Identresults Api Model class
 */

namespace SecucardConnect\Product\Services\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Identresults Api Model class
 *
 */
class IdentResult extends BaseModel
{
    const STATUS_OK = "ok";
    const STATUS_FAILED = "failed";
    const STATUS_PRELIMINARY_OK = "ok_preliminary";
    const STATUS_PRELIMINARY_FAILED = "failed_preliminary";

    /**
     * @var \SecucardConnect\Product\Services\Model\IdentRequest
     */
    public $request;

    /**
     * @var string
     */
    public $status;

    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var \SecucardConnect\Product\Payment\Model\Contract
     */
    public $contract;

    /**
     * @var ResultPerson
     */
    public $person;
}

class ResultPerson
{
    /**
     * @var \SecucardConnect\Product\Services\Model\IdentificationProcess
     */
    public $identificationprocess;

    /**
     * @var \SecucardConnect\Product\Services\Model\IdentificationDocument
     */
    public $identificationdocument;

    /**
     * @var CustomData
     */
    public $customdata;

    /**
     * @var ContactData
     */
    public $contactdata;

    /**
     * @var Attachment[]
     */
    public $attachments;

    /**
     * @var UserData
     */
    public $userdata;
}

class Attachment
{
    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $url;
}

class UserData
{
    /**
     * @var \SecucardConnect\Product\Services\Model\Value
     *
     */
    public $dob;

    /**
     * @var \SecucardConnect\Product\Services\Model\Value
     *
     */
    public $forename;

    /**
     * @var \SecucardConnect\Product\Services\Model\Value
     *
     */
    public $surename;

    /**
     * @var \SecucardConnect\Product\Services\Model\Value
     *
     */
    public $address;

    /**
     * @var \SecucardConnect\Product\Services\Model\Value
     *
     */
    public $birthplace;

    /**
     * @var \SecucardConnect\Product\Services\Model\Value
     *
     */
    public $nationality;


    /**
     * @var \SecucardConnect\Product\Services\Model\Value
     *
     */
    public $gender;
}

class CustomData
{
    /**
     * @var string
     */
    public $custom1;
    /**
     * @var string
     */
    public $custom2;

    /**
     * @var string
     */
    public $custom3;

    /**
     * @var string
     */
    public $custom4;

    /**
     * @var string
     */
    public $custom5;
}

class ContactData
{
    /**
     * @var string
     */
    public $mobile;

    /**
     * @var string
     */
    public $email;
}