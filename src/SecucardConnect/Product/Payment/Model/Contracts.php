<?php
/**
 * Payment Contracts Api Model class
 */

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Common\Model\MainModel;

/**
 * Payment Contracts Api Model class
 *
 */
class Contracts extends MainModel
{
    protected $_attribute_defs = array(
        'object' => array('type' => BaseModel::DATA_TYPE_STRING),
        'id' => array('type' => BaseModel::DATA_TYPE_STRING, 'options' => array('id' => true)),
        'demo' => array('type' => BaseModel::DATA_TYPE_BOOLEAN),
        'allow_cloning' => array('type' => BaseModel::DATA_TYPE_BOOLEAN),
        'sepa_mandate_inform' => array('type' => BaseModel::DATA_TYPE_STRING),
        'created' => array('type' => BaseModel::DATA_TYPE_DATETIME),
        'updated' => array('type' => BaseModel::DATA_TYPE_DATETIME),
    );

    protected $_relations = array(
        'parent' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'Payment', 'model' => 'Contracts'),
        'merchant' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'General', 'model' => 'Merchants'),
    );

}