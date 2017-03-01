<?php
/**
 * Base Model class
 */

namespace SecucardConnect\Product\Common\Model;

/**
 * Class that should be used as parent class of every main request Data model
 * Class does not implement lazy loading, so it cannot carry relations
 *
 * @author Rico Simlinger <r.simlinger@secupay.ag>
 */
abstract class BaseModelMain extends BaseModel
{
	/**
	 * @var ApiData
	 */
    public $api_data;
}