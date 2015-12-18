<?php

namespace SecucardConnect\Product\Services\Model;

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