<?php
/**
 * PaymentContainerData Common model class
 */

namespace secucard\models\Common;

use secucard\client\base\BaseModel;

/**
 * PaymentContainerData Data Model class
 *
 */
class PaymentContainerData extends BaseModel
{
    protected $_attribute_defs = array(
        'owner' => array('type' => BaseModel::DATA_TYPE_STRING),
        'iban' => array('type' => BaseModel::DATA_TYPE_STRING),
        'bic' => array('type' => BaseModel::DATA_TYPE_STRING),
        'bankname' => array('type' => BaseModel::DATA_TYPE_STRING),
    );

}