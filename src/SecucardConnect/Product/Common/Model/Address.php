<?php
/**
 * Address Common model class
 */

namespace SecucardConnect\Product\Common\Model;

/**
 * Address Data Model class
 *
 */
class Address extends BaseModel
{
    protected $_attribute_defs = array(
        'id'=>array('type'=>BaseModel::DATA_TYPE_STRING, 'options'=>array('id'=>true)),
        'a'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'b'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'c'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'd'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        );

    protected $_relations = array();

}