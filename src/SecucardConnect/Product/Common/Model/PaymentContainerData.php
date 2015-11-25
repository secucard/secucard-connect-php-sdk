<?php
/**
 * PaymentContainerData Common model class
 */

namespace SecucardConnect\Product\Common\Model;

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