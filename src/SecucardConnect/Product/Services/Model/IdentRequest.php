<?php
/**
 * Identrequests Api Model class
 */

namespace SecucardConnect\Product\Services\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\General\Model\Merchant;

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

    const PROVIDER_IDNOW = 'idnow';
    const PROVIDER_POST_IDENT = 'post_ident';
    const PROVIDER_BANK_IDENT = 'bank_ident';

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
     * @var RequestPerson[]
     */
    public $person;

	/**
	 * @var string
	 */
    public $provider;

	/**
	 * @var string
	 */
    public $use_internal_contract;

	/**
	 * @var Merchant[]
	 */
    public $assignment;

}

