<?php
/**
 * Payment Containers Api Model class
 */

namespace secucard\models\Payment;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

/**
 * Payment Containers Api Model class
 *
 */
class Containers extends MainModel
{
    protected $_attribute_defs = array(
        'object' => array('type' => BaseModel::DATA_TYPE_STRING),
        'id' => array('type' => BaseModel::DATA_TYPE_STRING, 'options' => array('id' => true)),
        'type' => array('type' => BaseModel::DATA_TYPE_STRING),
        'created' => array('type' => BaseModel::DATA_TYPE_DATETIME),
        'updated' => array('type' => BaseModel::DATA_TYPE_DATETIME),
        'demo' => array('type' => BaseModel::DATA_TYPE_BOOLEAN),
        // Public and private fields are subarrays
        'public' => array('type' => BaseModel::DATA_TYPE_ARRAY_SUBOBJECT, 'category' => 'Common', 'model' => 'PaymentContainerData'),
        'private' => array('type' => BaseModel::DATA_TYPE_ARRAY_SUBOBJECT, 'category' => 'Common', 'model' => 'PaymentContainerData'),
        //'assign' field is a relation - TODO implement correctly
        'assign' => array('type' => BaseModel::DATA_TYPE_ARRAY),
    );

    protected $_relations = array(
        'contract' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'Payment', 'model' => 'Contracts'),
        // TODO this is general relation. there can be more types of objects
        //'assign' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'General', 'model' => 'Common'),
    );

}