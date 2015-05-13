<?php
/**
 * Devices Api Model class
 */

namespace secucard\models\General;

use secucard\client\base\BaseModel;
use secucard\client\base\MainModel;

/**
 * Devices Api Model class
 *
 */
class Devices extends MainModel
{
    // TODO this model is not yet implemented correctly
    protected $_attribute_defs = array(
        'object' => array('type' => BaseModel::DATA_TYPE_STRING),
        'id' => array('type' => BaseModel::DATA_TYPE_STRING, 'options' => array('id' => true)),
    );

    protected $_relations = array();

    // model specific functions

}