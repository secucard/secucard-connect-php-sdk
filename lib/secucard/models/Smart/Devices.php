<?php
/**
 * Devices Api Model class
 */

namespace secucard\models\Smart;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

/**
 * Devices Api Model class
 *
 */
class Devices extends MainModel
{
    protected $_attribute_defs = array(
        'object' => array('type' => BaseModel::DATA_TYPE_STRING),
        'id' => array('type' => BaseModel::DATA_TYPE_STRING, 'options' => array('id' => true)),
        'vendor' => array('type' => BaseModel::DATA_TYPE_STRING),
        'vendor_uid' => array('type' => BaseModel::DATA_TYPE_STRING),
        'type' => array('type' => BaseModel::DATA_TYPE_STRING),
        'priority' => array('type' => BaseModel::DATA_TYPE_NUMBER),
        'description' => array('type' => BaseModel::DATA_TYPE_STRING),
        'user_pin' => array('type' => BaseModel::DATA_TYPE_STRING),
        'online' => array('type' => BaseModel::DATA_TYPE_BOOLEAN),
        'created' => array('type' => BaseModel::DATA_TYPE_DATETIME),
    );

    protected $_relations = array(
        'device' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'General', 'model' => 'Devices'),
        'merchant' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'General', 'model' => 'Merchants'),
        'store' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'General', 'model' => 'Stores'),
    );

}