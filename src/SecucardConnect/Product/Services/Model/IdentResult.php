<?php

namespace SecucardConnect\Product\Services\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Identresults Api Model class
 */
class IdentResult extends BaseModel
{
    const STATUS_OK = "ok";
    const STATUS_FAILED = "failed";
    const STATUS_PRELIMINARY_OK = "ok_preliminary";
    const STATUS_PRELIMINARY_FAILED = "failed_preliminary";

    /**
     * @var IdentRequest
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
     * @var Contract
     */
    public $contract;

    /**
     * @var ResultPerson[]
     */
    public $person;
}

