<?php
/**
 * Companys Api Model class
*/

namespace SecucardConnect\Product\Services\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Company Api Model class
 */
class Company extends BaseModel
{
	public $companyname;
	public $legal_type;
	public $register_court;
	public $salutation;
	public $title;
	public $forename;
	public $surname;
	public $address;
	public $url_website;
	public $tax_id;
	public $companyname;
}


/*
 'companyname' => new ProductModelMetaElement('string'),
 'legal_type' => new ProductModelMetaElement('string_not_analyzed'),
 'register_court' => new ProductModelMetaElement('string_not_analyzed'),
 'register_number' => new ProductModelMetaElement('string_not_analyzed'),
 'salutation' => new ProductModelMetaElement('string'),
 'title' => new ProductModelMetaElement('string'),
 'forename' => new ProductModelMetaElement('string'),
 'surname' => new ProductModelMetaElement('string'),
 'address' => new ProductModelMetaGroup([
 'address_components' => new ProductModelMetaList([
 'long_name' => new ProductModelMetaElement('string'),
 'short_name' => new ProductModelMetaElement('string'),
 'types' => new ProductModelMetaElementList('string'),
 ]),
 'address_formatted' => new ProductModelMetaElement('string'),
 'geometry' => new ProductModelMetaElement('geo_point'),
 ]),
 'url_website' => new ProductModelMetaElement('string'),
 'tax_id' => new ProductModelMetaElement('string'),
 */
