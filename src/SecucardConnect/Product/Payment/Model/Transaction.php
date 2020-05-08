<?php

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

    const PAYMENT_ACTION_AUTHORIZATION = "authorization"; // Use the Authorization option to place a hold on the payer funds.
    const PAYMENT_ACTION_SALE = "sale"; // Direct payment (immediate debit of the funds from the buyer's funding source)

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
     * @var array Basket[]
     */
    public $basket;

    /**
     * @var Experience
     */
    public $experience;

    /**
     * If TRUE the payout of the payment transaction will be blocked until the flag was removed (by calling capture).
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

    /**
     * @deprecated use $redirect_url
     * @var string
     */
    public $url_success;

    /**
     * @deprecated use $redirect_url
     * @var string
     */
    public $url_failure;

    /**
     * @deprecated use $redirect_url
     * @var string
     */
    public $iframe_url;

    /**
     * A list optional settings and parameters to customize the checkout process
     *
     * @var OptData
     */
    public $opt_data;

    /**
     * The "payment_action" parameter controls the processing of the transaction by secupay, for the time being,
     * there are the values "sale" and "authorization". Sale is a direct payment.
     * To perform the transaction later, you have to transmit “authorization” here.
     *
     * @var string
     */
    public $payment_action = self::PAYMENT_ACTION_SALE;

    /**
     * The payment data which has the payer used (like bank account, credit card, ...). This data is always masked.
     *
     * @var PaymentInstrument
     */
    public $used_payment_instrument;

    /**
     * @var array
     */
    public $sub_transactions;

    /**
     * payment transaction ID (PCI_...)
     * @var string
     */
    public $payment_id;

    /**
     * list of allowed payment methods, f.e. ['TWINT']
     * if no one was defined the custommer can select one by himself (based on your contract)
     * @var string
     */
    public $payment_methods;
}
