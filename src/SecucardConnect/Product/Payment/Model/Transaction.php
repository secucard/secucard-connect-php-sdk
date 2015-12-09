<?php
/**
 * Created by IntelliJ IDEA.
 * User: tk
 * Date: 09.12.15
 * Time: 09:19
 */

namespace SecucardConnect\Product\Payment\Model;


use SecucardConnect\Product\Common\Model\BaseModel;

class Transaction extends BaseModel
{
    const STATUS_ACCEPTED = "accepted";
    const STATUS_CANCELED = "canceled";
    const STATUS_PROCEED = "proceed";

    /**
     * @var \SecucardConnect\Product\Payment\Model\Contract
     */
    public $contract;

    /**
     * @var int
     */
    public $amount;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var string
     */
    public $purpose;

    /**
     * @var string
     */
    public $order_id;

    /**
     * @var string
     */
    public $trans_id;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $transaction_status;
}