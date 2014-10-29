<?php
/**
 * IdentrequestsPerson
 */

namespace secucard\models\Services;

use secucard\client\base\BaseModel;

/**
 * IdentrequestsPerson Api Model class
 *
 */
class IdentrequestsPerson extends BaseModel
{
    protected $_attribute_defs = array(
        'transaction_id'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'redirect_url'=>array('type'=>BaseModel::DATA_TYPE_URL),
        'status'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'owner_transaction_id'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'firstname'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'lastname'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'birthdate'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'birthplace'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'gender'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'nationality'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'email'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'mobilephone'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'custom1'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'custom2'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'custom3'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'custom4'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'custom5'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'street'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'city'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'country'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'zipcode'=>array('type'=>BaseModel::DATA_TYPE_STRING),
    );

    protected $_relations = array(
        );

}