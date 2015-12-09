<?php
/**
 * Payment Secupayprepays Api Model class
 */

namespace SecucardConnect\Product\Payment\Model;

/**
 * Payment Secupayprepays Api Model class
 *
 */
class SecupayPrepay extends Transaction
{
    /**
     * @var \SecucardConnect\Product\Payment\Model\Customer
     */
    public $customer;

    /**
     * @var string
     */
    public $transfer_purpose;

    /**
     * @var TransferAccount
     */
    public $transfer_account;

}

class TransferAccount
{
    /**
     * @var string
     */
    public $account_owner;

    /**
     * @var string
     */
    public $accountnumber;

    /**
     * @var string
     */
    public $iban;

    /**
     * @var string
     */
    public $bic;

    /**
     * @var string
     */
    public $bankcode;

}