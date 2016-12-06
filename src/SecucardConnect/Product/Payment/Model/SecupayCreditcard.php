<?php
/**
 * Payment Secupaycreditcards Api Model class
 */

namespace SecucardConnect\Product\Payment\Model;

/**
 * Payment Secupaycreditcards Api Model class
 *
 */
class SecupayCreditcard extends Transaction
{
    /**
     * @var \SecucardConnect\Product\Payment\Model\Customer
     */
    public $customer;

    public $url_success;

    public $url_failure;

    public $iframe_url;

}