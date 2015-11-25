<?php
/**
 * Checkins Api Model class
 */

namespace SecucardConnect\Product\Smart\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Common\Model\MainModel;

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