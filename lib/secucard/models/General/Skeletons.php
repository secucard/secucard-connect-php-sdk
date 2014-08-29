<?php
/**
 * Skeletons Api Model class
 */

namespace secucard\models\General;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

/**
 * Skeletons Api Model class
 *
 */
class Skeletons extends MainModel
{
    protected $_attribute_defs = array(
        'object'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'id'=>array('type'=>BaseModel::DATA_TYPE_NUMBER, 'id'=>true, 'options'=>array()),
        'a'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'b'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'c'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'amount'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'date'=>array('type'=>BaseModel::DATA_TYPE_DATETIME),
        'picture'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'type'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        // TODO
        'location'=>array('type'=>BaseModel::RELATION_HAS_ONE, 'class'=>'Common\\Location'),
        // TODO
        'skeleton'=>array('type'=>BaseModel::RELATION_HAS_ONE),
        // TODO
        'skeleton_list'=>array('type'=>BaseModel::RELATION_HAS_ONE),
        );

    protected $_relations = array(
        //'location'=>array('type'=>BaseModel::RELATION_HAS_ONE, 'class'=>'Common\\Location'),
        );

    // model specific functions
}