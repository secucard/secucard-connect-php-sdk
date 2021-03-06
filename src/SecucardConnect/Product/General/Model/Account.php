<?php
/**
 * Accounts Api Model class
 */

namespace SecucardConnect\Product\General\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Accounts Api Model class
 *
 */
class Account extends BaseModel
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var array
     */
    public $role;

    /**
     * @var \SecucardConnect\Product\General\Model\Assignment[]
     */
    public $assignment;

    /**
     * @var array
     */
    public $invitation;

    /**
     * @var array
     */
    public $social;


    /**
     * @var \SecucardConnect\Product\Common\Model\Contact
     */
    public $contact;
}
