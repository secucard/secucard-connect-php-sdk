<?php
/**
 * Payment Customers Api Model class
 */

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Common\Model\MainModel;

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

    // Set updatable flag
    protected $_is_updatable = true;

    // Set deletable flag
    protected $_is_deletable = true;
}