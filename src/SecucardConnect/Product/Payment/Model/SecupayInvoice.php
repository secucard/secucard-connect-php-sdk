<?php
/**
 * Payment Secupayinvoices Api Model class
 */

namespace SecucardConnect\Product\Payment\Model;

/**
 * Payment Secupayinvoices Api Model class
 *
 */
class SecupayInvoice extends Transaction
{
    /**
     * @var string
     */
    public $transfer_purpose;

    /**
     * @var TransferAccount
     */
    public $transfer_account;
}
