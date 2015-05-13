<?php
/**
 * Transactions Api Model class
 */

namespace secucard\models\Smart;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

/**
 * Transactions Api Model class
 *
 */
class Transactions extends MainModel
{
    protected $_attribute_defs = array(
        'object' => array('type' => BaseModel::DATA_TYPE_STRING),
        'id' => array('type' => BaseModel::DATA_TYPE_STRING, 'options' => array('id' => true)),
        'status' => array('type' => BaseModel::DATA_TYPE_STRING),
        'merchantRef' => array('type' => BaseModel::DATA_TYPE_STRING),
        'transactionRef' => array('type' => BaseModel::DATA_TYPE_STRING),
        'basket' => array('type' => BaseModel::DATA_TYPE_ARRAY), // TODO move to relations
        'basket_info' => array('type' => BaseModel::DATA_TYPE_ARRAY), // TODO move to relations
        'idents' => array('type' => BaseModel::DATA_TYPE_ARRAY), // TODO move to relations
        'receipt' => array('type' => BaseModel::DATA_TYPE_ARRAY), // TODO move to relations
        'created' => array('type' => BaseModel::DATA_TYPE_DATETIME),
        'updated' => array('type' => BaseModel::DATA_TYPE_DATETIME),
    );

    protected $_relations = array(
        'merchant' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'General', 'model' => 'Merchants'),
        //'customer' => array('type' => MainModel::RELATION_HAS_MANY, 'category' => 'Loyalty', 'model' => 'Customers'),
    );

}