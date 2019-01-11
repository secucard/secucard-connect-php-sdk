<?php

namespace SecucardConnect\Product\Services\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\General\Model\Merchant;

/**
 * Uploadidents Api Model class
 *
 */
class Uploadident extends BaseModel
{

    /**
     * The payment transactions id
     *
     * @var string
     */
    public $payment_id;

    /**
     * A list of the uploaded file ids
     *
     * @var string[]
     */
    public $documents;

    /**
     * The ID of the created service case which was created to validate the payer / investor.
     * (readonly)
     *
     * @var int
     */
    public $service_issue_id;
}

