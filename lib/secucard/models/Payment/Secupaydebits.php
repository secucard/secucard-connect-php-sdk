<?php
/**
 * Payment Secupaydebits Api Model class
 */

namespace secucard\models\Payment;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

/**
 * Payment Secupaydebits Api Model class
 *
 */
class Secupaydebits extends MainModel
{
    protected $_attribute_defs = array(
        'object' => array('type' => BaseModel::DATA_TYPE_STRING),
        'id' => array('type' => BaseModel::DATA_TYPE_STRING, 'options' => array('id' => true)),
        'amount' => array('type' => BaseModel::DATA_TYPE_NUMBER), // amount in cents!
        'currency' => array('type' => BaseModel::DATA_TYPE_STRING),
        'purpose' => array('type' => BaseModel::DATA_TYPE_STRING),
        'order_id' => array('type' => BaseModel::DATA_TYPE_STRING),
        'trans_id' => array('type' => BaseModel::DATA_TYPE_STRING),
        'status' => array('type' => BaseModel::DATA_TYPE_STRING),
        'transaction_status' => array('type' => BaseModel::DATA_TYPE_STRING),

    );

    protected $_relations = array(
        'container' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'Payment', 'model' => 'Container'),
        'contract' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'Payment', 'model' => 'Contracts'),
        'customer' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'Payment', 'model' => 'Customers'),
    );

}