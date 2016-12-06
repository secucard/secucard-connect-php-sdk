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

	/**
	 * @var string
	 */
    public $url_success;

	/**
	 * @var string
	 */
    public $url_failure;

	/**
	 * @var string
	 */
    public $iframe_url;

}