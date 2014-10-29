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
        'redirect_url'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'status'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'owner_transaction_id'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'request_data'=>array('type'=>BaseModel::DATA_TYPE_ARRAY),
        );

    protected $_relations = array(
        );

}