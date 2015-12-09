<?php
/**
 * Identrequests Api Model class
 */

namespace SecucardConnect\Product\Services\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Identrequests Api Model class
 *
 */
class IdentRequest extends BaseModel
{
    const TYPE_PERSON = "person";
    const TYPE_COMPANY = "company";
    const STATUS_REQUESTED = "requested";
    const STATUS_OK = "ok";
    const STATUS_FAILED = "failed";

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $owner;

    /**
     * @var string
     */
    public $owner_transaction_id;

    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var \SecucardConnect\Product\Services\Model\Contract
     */
    public $contract;

    /**
     * @var RequestPerson
     */
    public $person;

}

class RequestPerson
{
    /**
     * @var string
     */
    public $transacion_id;

    /**
     * @var string
     */
    public $redirect_url;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $owner_transaction_id;

    /**
     * @var \SecucardConnect\Product\Common\Model\Contact
     */
    public $contact;

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