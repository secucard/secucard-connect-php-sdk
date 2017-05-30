<?php

namespace SecucardConnect\Product\Services\Model;

/**
 * Class RequestPerson
 */
class RequestPerson extends CustomData
{
    /**
     * @var string
     */
    public $transaction_id;

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
     * @var Contact
     */
    public $contact;
}