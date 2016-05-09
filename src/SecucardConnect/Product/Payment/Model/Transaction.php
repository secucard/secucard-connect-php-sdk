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
    const STATUS_ACCEPTED = "accepted"; // status for accepted debit transactions and finished prepay transactions
    const STATUS_AUTHORIZED = "authorized"; // prepay transaction after creation , before payment arrives
    const STATUS_DENIED = "denied"; // when scoring for debit transaction denies the payer
    const STATUS_ISSUE = "issue"; // then ruecklastschrift happens, or some other issue type
    const STATUS_VOID = "void"; // when transaction is cancelled by creator (it is not possible to cancel transactions any time, so the debit transaction is possible to cancel until it is cleared out)
    const STATUS_ISSUE_RESOLVED = "issue_resolved"; // when issue for transaction is resolved
    const STATUS_REFUND = "refund"; // special status, saying that transaction was paid back (for some reason)
    const STATUS_INTERNAL_SERVER_STATUS = "internal_server_status"; // should not happen, but only when status would be empty, this status is used

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
