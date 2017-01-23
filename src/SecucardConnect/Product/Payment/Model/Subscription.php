<?php

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Subscription Data Model class
 *
 */
class Subscription extends BaseModel
{
	/**
	 * The name of the subscription (for the customer)
	 *
	 * @var string
	 */
	public $purpose;
}