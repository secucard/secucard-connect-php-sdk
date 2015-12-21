<?php
/**
 * Transactions Api Model class
 */

namespace SecucardConnect\Product\Smart\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Transactions Api Model class
 *
 */
class Transaction extends BaseModel
{
    const STATUS_CREATED = "created";
    const STATUS_PROCESSING = "processing";
    const STATUS_CANCELED = "canceled";
    const STATUS_FINISHED = "finished";
    const STATUS_ABORTED = "aborted";
    const STATUS_FAILED = "failed";
    const STATUS_TIMEOUT = "timeout";
    const STATUS_OK = "ok";

    /**
     * @var \SecucardConnect\Product\Smart\Model\Device
     */
    public $device_source;

    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var \DateTime
     */
    public $updated;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $transactionRef;

    /**
     * @var string
     */
    public $merchantRef;

    /**
     * @var Basket
     */
    public $basket;

    /**
     * @var \SecucardConnect\Product\Smart\Model\ReceiptLine[]
     */
    public $receipt;

    /**
     * @var \SecucardConnect\Product\Smart\Model\BasketInfo
     */
    public $basket_info;

    /**
     * @var \SecucardConnect\Product\Smart\Model\Ident[]
     */
    public $idents;

    /**
     * @var \SecucardConnect\Product\Smart\Model\Device
     */
    public $target_device;

    /**
     * @var string
     */
    public $payment_method;

    /**
     * @var string
     */
    public $payment_requested;

    /**
     * @var string
     */
    public $payment_executed;

    /**
     * @var string
     */
    public $error;
}