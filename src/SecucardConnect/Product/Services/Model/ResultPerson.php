<?php

namespace SecucardConnect\Product\Services\Model;

/**
 * Class ResultPerson
 */
class ResultPerson
{
    /**
     * @var IdentificationProcess
     */
    public $identificationprocess;

    /**
     * @var IdentificationDocument
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