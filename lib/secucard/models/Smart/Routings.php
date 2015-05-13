<?php
/**
 * Routings Api Model class
 */

namespace secucard\models\Smart;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

/**
 * Routings Api Model class
 *
 */
class Routings extends MainModel
{
    protected $_attribute_defs = array(
        'object' => array('type' => BaseModel::DATA_TYPE_STRING),
        'id' => array('type' => BaseModel::DATA_TYPE_STRING, 'options' => array('id' => true)),
        'description' => array('type' => BaseModel::DATA_TYPE_STRING),
        'picture' => array('type' => BaseModel::DATA_TYPE_STRING),
        'created' => array('type' => BaseModel::DATA_TYPE_DATETIME),
    );

    protected $_relations = array(
        'store' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'General', 'model' => 'Stores'),
        'assign' => array('type' => MainModel::RELATION_HAS_MANY, 'category' => 'Smart', 'model' => 'Devices'),
    );

}