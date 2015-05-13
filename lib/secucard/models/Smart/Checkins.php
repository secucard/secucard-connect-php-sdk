<?php
/**
 * Checkins Api Model class
 */

namespace secucard\models\Smart;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

/**
 * Checkins Api Model class
 *
 */
class Checkins extends MainModel
{
    protected $_attribute_defs = array(
        'object' => array('type' => BaseModel::DATA_TYPE_STRING),
        'id' => array('type' => BaseModel::DATA_TYPE_STRING, 'options' => array('id' => true)),
        'customerName' => array('type' => BaseModel::DATA_TYPE_STRING),
        'picture' => array('type' => BaseModel::DATA_TYPE_STRING),
        'created' => array('type' => BaseModel::DATA_TYPE_DATETIME),
    );

    protected $_relations = array(
        'account' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'General', 'model' => 'Accounts'),
        'customer' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'Loyalty', 'model' => 'Customers'),
        'merchantcard' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'Loyalty', 'model' => 'Merchantcards'),
    );

}