<?php
/**
 * Identcontracts Api Model class
 */

namespace secucard\models\Services;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

/**
 * Identcontracts Api Model class
 *
 */
class Identcontracts extends MainModel
{
    protected $_attribute_defs = array(
        'object' => array('type' => BaseModel::DATA_TYPE_STRING),
        'id' => array('type' => BaseModel::DATA_TYPE_STRING, 'options' => array('id' => true)),
        'demo' => array('type' => BaseModel::DATA_TYPE_BOOLEAN),
        'redirect_url_success' => array('type' => BaseModel::DATA_TYPE_STRING),
        'redirect_url_failed' => array('type' => BaseModel::DATA_TYPE_STRING),
        'push_url' => array('type' => BaseModel::DATA_TYPE_STRING),
        'created' => array('type' => BaseModel::DATA_TYPE_DATETIME),
    );

    protected $_relations = array(
        'merchant' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'General', 'model' => 'Merchants'),
    );

}