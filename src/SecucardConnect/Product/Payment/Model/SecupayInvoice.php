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
     * @var \SecucardConnect\Product\Payment\Model\Customer
     */
    public $customer;

}