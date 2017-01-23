<?php
/**
 * Created by IntelliJ IDEA.
 * User: tk
 * Date: 09.12.15
 * Time: 09:19
 */

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Class Transaction
 * @package SecucardConnect\Product\Payment\Model
 */
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
	 * @var \SecucardConnect\Product\Payment\Model\Customer
	 */
	public $customer;

	/**
	 * @var \SecucardConnect\Product\Payment\Model\Customer (optional)
	 */
	public $recipient;

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

    /**
     * A list of basket items
     *
     * @var Basket[]
     */
    public $basket;

	/**
	 * @var Experience
	 */
    public $experience;

	/**
	 * If TRUE the payment transaction will be only a pre-authorization
	 * and a separate capture or cancel is needed to start the payment processing.
	 *
	 * @var bool (optional)
	 */
    public $accrual;

	/**
	 * @var Subscription (optional)
	 */
    public $subscription;

	/**
	 * A list of redirect urls used for the payment checkout page
	 *
	 * @var RedirectUrl
	 */
    public $redirect_url;
}
