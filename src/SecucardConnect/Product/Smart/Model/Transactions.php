<?php
/**
 * Transactions Api Model class
 */

namespace SecucardConnect\Product\Smart\Model;

use secucard\models\Smart\Receipts;
use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Common\Model\MainModel;

/**
 * Transactions Api Model class
 *
 */
class Transactions extends MainModel
{
    const STATUS_CREATED = "created";
    const STATUS_PROCESSING = "processing";
    const STATUS_FINISHED = "finished";
    const STATUS_ABORTED = "aborted";
    const STATUS_FAILED = "failed";
    const STATUS_TIMEOUT = "timeout";
    const STATUS_OK = "ok";

    protected $_attribute_defs = array(
        'object' => array('type' => BaseModel::DATA_TYPE_STRING),
        'id' => array('type' => BaseModel::DATA_TYPE_STRING, 'options' => array('id' => true)),
        'status' => array('type' => BaseModel::DATA_TYPE_STRING),
        'merchantRef' => array('type' => BaseModel::DATA_TYPE_STRING),
        'transactionRef' => array('type' => BaseModel::DATA_TYPE_STRING),
        'basket' => array('type' => BaseModel::DATA_TYPE_ARRAY), // TODO move to relations
        'basket_info' => array('type' => BaseModel::DATA_TYPE_ARRAY), // TODO move to relations
        'idents' => array('type' => BaseModel::DATA_TYPE_ARRAY), // TODO move to relations
        'receipt' => array('type' => BaseModel::DATA_TYPE_ARRAY_SPECIAL),
        'created' => array('type' => BaseModel::DATA_TYPE_DATETIME),
        'updated' => array('type' => BaseModel::DATA_TYPE_DATETIME),
    );

    protected $_relations = array(
        'merchant' => array('type' => MainModel::RELATION_HAS_ONE, 'category' => 'General', 'model' => 'Merchants'),
        //'customer' => array('type' => MainModel::RELATION_HAS_MANY, 'category' => 'Loyalty', 'model' => 'Customers'),
    );

    /**
     * Function that parses value for 'receipt' field
     * @see secucard\client\base.BaseModel::_parseSpecialObjectsArray()
     */
    protected function _parseSpecialObjectsArray($attribute, $value)
    {
        if ($attribute == 'receipt') {
            $receipts = new Receipts();
            return $receipts->parseReceipts($value);
        }
        return [];
    }
}