<?php

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Experience Data Model class
 *
 */
class Experience extends BaseModel
{
	/**
	 * The number of positive customer experiences
	 *
	 * @var int
	 */
	public $positiv;

	/**
	 * The number of negative customer experiences (open orders
	 *
	 * @var int
	 */
	public $negativ;
}