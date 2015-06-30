<?php
/**
 * Payment Customers Api Model class
 */

namespace secucard\models\Payment;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

/**
 * Payment Customers Api Model class
 *
 */
class Customers extends MainModel
{
    protected $_attribute_defs = array(
        'object' => array('type' => BaseModel::DATA_TYPE_STRING),
        'id' => array('type' => BaseModel::DATA_TYPE_STRING, 'options' => array('id' => true)),
        'created' => array('type' => BaseModel::DATA_TYPE_DATETIME),
    );

    protected $_relations = array(
        'contract' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'Payment', 'model' => 'Contracts'),
        'contact' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'Common', 'model' => 'Contact'),
    );

}