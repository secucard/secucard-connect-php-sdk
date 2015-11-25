<?php
/**
 * Merchants Api Model class
 */

namespace SecucardConnect\Product\General\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Common\Model\MainModel;

/**
 * Merchants Api Model class
 *
 */
class Merchants extends MainModel
{
    // TODO this class is not yet implemented
    protected $_attribute_defs = array(
        'object' => array('type' => BaseModel::DATA_TYPE_STRING),
        'id' => array('type' => BaseModel::DATA_TYPE_STRING, 'options' => array('id' => true)),
    );

    protected $_relations = array(
        //
    );
}