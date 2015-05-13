<?php
/**
 * IdentrequestsPerson
 */

namespace secucard\models\Services;

use secucard\client\base\BaseModel;

/**
 * IdentrequestsPerson Api Model class
 *
 */
class IdentrequestsPerson extends BaseModel
{
    protected $_attribute_defs = array(
        'transaction_id' => array('type' => BaseModel::DATA_TYPE_STRING),
        'redirect_url' => array('type' => BaseModel::DATA_TYPE_STRING),
        'status' => array('type' => BaseModel::DATA_TYPE_STRING),
        'custom1' => array('type' => BaseModel::DATA_TYPE_STRING),
        'custom2' => array('type' => BaseModel::DATA_TYPE_STRING),
        'custom3' => array('type' => BaseModel::DATA_TYPE_STRING),
        'custom4' => array('type' => BaseModel::DATA_TYPE_STRING),
        'custom5' => array('type' => BaseModel::DATA_TYPE_STRING),
        'contact' => array('type' => BaseModel::DATA_TYPE_ARRAY_SUBOBJECT, 'category' => 'Common', 'model' => 'Contact'),
    );

}