<?php
/**
 * Merchants Api Model class
 */

namespace secucard\models\General;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

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