<?php
/**
 * Identrequests Api Model class
 */

namespace secucard\models\Services;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

/**
 * Identrequests Api Model class
 *
 */
class Identrequests extends MainModel
{
    protected $_attribute_defs = array(
        'object'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'id'=>array('type'=>BaseModel::DATA_TYPE_STRING, 'options'=>array('id'=>true)),
        'type'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'status'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'owner_transaction_id'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'owner'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'created'=>array('type'=>BaseModel::DATA_TYPE_DATETIME),
        );

    protected $_relations = array(
        'person'=>array('type'=>MainModel::RELATION_HAS_MANY, 'category'=>'Services', 'model'=>'IdentrequestsPerson'),
        );

}