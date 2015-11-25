<?php
/**
 * Payment Secupaydebits Api Model class
 */

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Common\Model\MainModel;

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
        'container' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'Payment', 'model' => 'Containers'),
        'contract' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'Payment', 'model' => 'Contracts'),
        // Relation to customer has been removed, because container has the relation to customer
        //'customer' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'Payment', 'model' => 'Customers'),
    );

}