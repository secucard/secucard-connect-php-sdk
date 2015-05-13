<?php
/**
 * Contactaddress Common model class
 */

namespace secucard\models\Common;

use secucard\client\base\BaseModel;

/**
 * Contactaddress Data Model class
 *
 */
class Contactaddress extends BaseModel
{
    protected $_attribute_defs = array(
        'street' => array('type' => BaseModel::DATA_TYPE_STRING),
        'street_number' => array('type' => BaseModel::DATA_TYPE_STRING),
        'city' => array('type' => BaseModel::DATA_TYPE_STRING),
        'postal_code' => array('type' => BaseModel::DATA_TYPE_STRING),
        'country' => array('type' => BaseModel::DATA_TYPE_STRING),
    );

}