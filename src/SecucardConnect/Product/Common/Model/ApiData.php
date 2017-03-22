<?php
/**
 * ApiData Common model class
 */

namespace SecucardConnect\Product\Common\Model;

use SecucardConnect\SecucardConnect;

/**
 * Address Data Model class
 *
 */
class ApiData extends BaseModel
{
	/**
	 * Enable demo mode (for this api call)
	 *
	 * @var bool
	 */
	public $demo;

	/**
	 * Define the language for the response messages
	 * Default: "en"
	 *
	 * @var string
	 */
	public $language;

	/**
	 * Define the api client id (it's like the user agent string for browsers)
	 * Definition: "{name}/{version}", separator "; "
	 * Example: "Wordpress/4.7.1; WooCommerce/2.6.11; PHP-SDK/1.2.0"
	 *
	 * @var string
	 */
	public $api_client = 'PHP-SDK/' . SecucardConnect::VERSION;
}