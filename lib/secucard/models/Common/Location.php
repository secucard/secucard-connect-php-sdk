<?php
/**
 * Location Common model class
 */

namespace secucard\models\Common;

use secucard\client\base\BaseModel;

/**
 * Location Data Model class
 *
 */
class Location extends BaseModel
{
    protected $_attribute_defs = array(
        'lat'=>array('type'=>BaseModel::DATA_TYPE_FLOAT),
        'lon'=>array('type'=>BaseModel::DATA_TYPE_FLOAT),
        );

    protected $_relations = array();

}