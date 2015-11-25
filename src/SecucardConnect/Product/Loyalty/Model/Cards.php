<?php
/**
 * Cards Api Model class
 */

namespace SecucardConnect\Product\Loyalty\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Common\Model\MainModel;

/**
 * Cards Api Model class
 *
 */
class Cards extends MainModel
{
    protected $_attribute_defs = array(
        'object'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'id'=>array('type'=>BaseModel::DATA_TYPE_STRING, 'options'=>array('id'=>true)),
        'cardnumber'=>array('type'=>BaseModel::DATA_TYPE_STRING),
        'created'=>array('type'=>BaseModel::DATA_TYPE_DATETIME),
        );

    protected $_relations = array(
        'account'=>array('type'=>MainModel::RELATION_HAS_ONE, 'category'=>'General', 'model'=>'Accounts'),
        );

}