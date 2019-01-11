<?php

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Class TransactionsDetails
 * @package SecucardConnect\Product\Payment\Model
 */
class TransactionsDetails extends BaseModel
{
    /**
     * @var string
     */
    public $cleared;

    /**
     * @var int
     */
    public $status;

    /**
     * @var string
     */
    public $status_text;

    /**
     * @var int
     */
    public $status_simple;

    /**
     * @var string
     */
    public $status_simple_text;

    /**
     * @var int
     */
    public $amount;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $description_raw;
}
