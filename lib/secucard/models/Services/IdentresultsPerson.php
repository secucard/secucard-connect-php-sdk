<?php
/**
 * IdentresultsPerson
 */

namespace secucard\models\Services;

use secucard\client\base\BaseModel;

/**
 * IdentresultsPerson Api Model class
 *
 */
class IdentresultsPerson extends BaseModel
{
    protected $_attribute_defs = array(
        'identificationprocess'=>array('type'=>BaseModel::DATA_TYPE_ARRAY),
        'customdata'=>array('type'=>BaseModel::DATA_TYPE_ARRAY),
        'attachments'=>array('type'=>BaseModel::DATA_TYPE_ARRAY),
        'userdata'=>array('type'=>BaseModel::DATA_TYPE_ARRAY),
        'identificationdocument'=>array('type'=>BaseModel::DATA_TYPE_ARRAY),
        );

    protected $_relations = array(
        );

}