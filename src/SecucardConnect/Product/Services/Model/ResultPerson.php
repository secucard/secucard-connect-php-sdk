<?php

namespace SecucardConnect\Product\Services\Model;

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