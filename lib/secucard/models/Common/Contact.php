<?php
/**
 * Contact Common model class
 */

namespace secucard\models\Common;

use secucard\client\base\BaseModel;

/**
 * Contact Data Model class
 *
 */
class Contact extends BaseModel
{
    protected $_attribute_defs = array(
        'salutation' => array('type' => BaseModel::DATA_TYPE_STRING),
        'title' => array('type' => BaseModel::DATA_TYPE_STRING),
        'forename' => array('type' => BaseModel::DATA_TYPE_STRING),
        'surname' => array('type' => BaseModel::DATA_TYPE_STRING),
        'name' => array('type' => BaseModel::DATA_TYPE_STRING), // not used for now
        'companyname' => array('type' => BaseModel::DATA_TYPE_STRING),
        // TODO check if date is correct!
        'dob' => array('type' => BaseModel::DATA_TYPE_DATE),
        'birthplace' => array('type' => BaseModel::DATA_TYPE_STRING),
        'nationality' => array('type' => BaseModel::DATA_TYPE_STRING),
        'gender' => array('type' => BaseModel::DATA_TYPE_STRING),
        'phone' => array('type' => BaseModel::DATA_TYPE_STRING),
        'mobile' => array('type' => BaseModel::DATA_TYPE_STRING),
        'email' => array('type' => BaseModel::DATA_TYPE_STRING),
        'picture' => array('type' => BaseModel::DATA_TYPE_STRING),
        'url_website' => array('type' => BaseModel::DATA_TYPE_STRING),
        // Address is subarray
        'address' => array('type' => BaseModel::DATA_TYPE_ARRAY_SUBOBJECT, 'category' => 'Common', 'model' => 'Contactaddress'),
    );

}