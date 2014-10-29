<?php
/**
 * Identrequests Api Model class
 */

namespace secucard\models\Services;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

/**
 * Skeletons Api Model class
 *
 */
class Identrequests extends MainModel
{
    protected $_attribute_defs = array(
        'object'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'id'=>array('type'=>BaseModel::DATA_TYPE_STRING, 'options'=>array('id'=>true)),
        'type'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'created'=>array('type'=>BaseModel::DATA_TYPE_DATETIME),
        );

    protected $_relations = array(
        'location'=>array('type'=>MainModel::RELATION_HAS_ONE, 'category'=>'Common', 'model'=>'Location'),
        // TODO
        'skeleton'=>array('type'=>MainModel::RELATION_HAS_ONE, 'category'=>'General', 'model'=>'Skeletons'),
        // TODO
        'skeleton_list'=>array('type'=>MainModel::RELATION_HAS_MANY, 'category'=>'General', 'model'=>'Skeletons'),
        );

    // model specific functions
}