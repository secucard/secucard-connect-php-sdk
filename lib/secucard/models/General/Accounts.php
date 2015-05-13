<?php
/**
 * Accounts Api Model class
 */

namespace secucard\models\General;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

/**
 * Accounts Api Model class
 *
 */
class Accounts extends MainModel
{
    protected $_attribute_defs = array(
        'object' => array('type' => BaseModel::DATA_TYPE_STRING),
        'id' => array('type' => BaseModel::DATA_TYPE_STRING, 'options' => array('id' => true)),
        'username' => array('type' => BaseModel::DATA_TYPE_STRING),
        'role' => array('type' => BaseModel::DATA_TYPE_STRING),
        'assignment' => array('type' => BaseModel::DATA_TYPE_ARRAY),
        'invitation' => array('type' => BaseModel::DATA_TYPE_ARRAY),
        'social' => array('type' => BaseModel::DATA_TYPE_ARRAY),
    );

    protected $_relations = array(
        'contact' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'Common', 'model' => 'Contact'),
    );

    // model specific functions

}