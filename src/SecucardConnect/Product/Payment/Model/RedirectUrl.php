<?php

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * RedirectUrl Data Model class
 *
 */
class RedirectUrl extends BaseModel
{
	/**
	 * The url for redirect the customer back to the shop after a successful payment checkout
	 *
	 * @var string
	 */
	public $url_success;

	/**
	 * The url for redirect the customer back to the shop after a failure (or on cancel) on the payment checkout page
	 *
	 * @var string
	 */
	public $url_failure;

	/**
	 * The url for redirect the customer to the payment checkout page
	 *
	 * @var string
	 */
	public $iframe_url;
}