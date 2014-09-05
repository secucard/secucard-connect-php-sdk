<?php
/**
 * Accounts Api Model class
 */

namespace secucard\models\General;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

/**
 * Accounts Api Model class
 *
 */
class Accounts extends MainModel
{
    protected $_attribute_defs = array(
        'object'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'id'=>array('type'=>BaseModel::DATA_TYPE_STRING, 'options'=>array('id'=>true)),
        'iban'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'bic'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'forename'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'surname'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'display_name'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        );

    protected $_relations = array();


    // model specific functions

}