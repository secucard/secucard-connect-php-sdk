<?php
/**
 * Skeletons Api Model class
 */

namespace SecucardConnect\Product\General\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Common\Model\MainModel;

/**
 * Skeletons Api Model class
 *
 */
class Skeletons extends MainModel
{
    protected $_attribute_defs = array(
        'object'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'id'=>array('type'=>BaseModel::DATA_TYPE_STRING, 'options'=>array('id'=>true)),
        'a'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'b'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'c'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'amount'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'date'=>array('type'=>BaseModel::DATA_TYPE_DATETIME),
        'picture'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'type'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        );

    protected $_relations = array(
        //'location'=>array('type'=>BaseModel::RELATION_HAS_ONE, 'class'=>'Common\\Location'),

        'location'=>array('type'=>MainModel::RELATION_HAS_ONE, 'category'=>'Common', 'model'=>'Location'),
        // TODO
        'skeleton'=>array('type'=>MainModel::RELATION_HAS_ONE, 'category'=>'General', 'model'=>'Skeletons'),
        // TODO
        'skeleton_list'=>array('type'=>MainModel::RELATION_HAS_MANY, 'category'=>'General', 'model'=>'Skeletons'),
        );

    // model specific functions
}