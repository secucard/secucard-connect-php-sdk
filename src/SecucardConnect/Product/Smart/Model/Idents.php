<?php
/**
 * Idents Api Model class
 */

namespace SecucardConnect\Product\Smart\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Common\Model\MainModel;

/**
 * Idents Api Model class
 *
 */
class Idents extends MainModel
{
    protected $_attribute_defs = array(
        'object' => array('type' => BaseModel::DATA_TYPE_STRING),
        'id' => array('type' => BaseModel::DATA_TYPE_STRING, 'options' => array('id' => true)),
        'type' => array('type' => BaseModel::DATA_TYPE_STRING),
        'prefix' => array('type' => BaseModel::DATA_TYPE_STRING),
        'length' => array('type' => BaseModel::DATA_TYPE_STRING),
        'name' => array('type' => BaseModel::DATA_TYPE_STRING),
    );

    protected $_relations = array(
        //
    );

}