<?php
/**
 * Receipts model class
 */

namespace SecucardConnect\Product\Smart\Model;

/**
 * Receipts class to parse Receipts array to subclasses
 *
 */
class Receipts
{

    /**
     * Function to parse receipts from multidimensional array to array of objects
     * @param array $params
     * @return array of objects
     * @throws \Exception
     */
    public function parseReceipts($params)
    {
        $ret = array();
        if (empty($params) || !is_array($params)) {
            return $ret;
        }

        foreach ($params as $receipt) {
            $new_receipt = null;
            switch ($receipt['type']) {
                case ReceiptTextline::TYPE:
                    $new_receipt = new ReceiptTextline();
                    break;
                case ReceiptSeparator::TYPE:
                    $new_receipt = new ReceiptSeparator();
                    break;
                case ReceiptSpace::TYPE:
                    $new_receipt = new ReceiptSpace();
                    break;
                case ReceiptNameValue::TYPE:
                    $new_receipt = new ReceiptNameValue();
                    break;
                default:
                    throw new \Exception('Received unknown Receipt type ' . $receipt['type']);
                    break;
            }
            $new_receipt->setAttributes($receipt['value']);
            $ret[] = $new_receipt;
        }

        return $ret;
    }
}

class ReceiptBase
{
    const TYPE = 'base';

    /**
     * Function to set attributes on current object
     * @param array $values
     */
    public function setAttributes($values)
    {
        if (empty($values) || !is_array($values)) {
            return;
        }

        foreach ($values as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Function that returns array representation for current object
     * @return array
     */
    public function __toArray()
    {
        $values = get_object_vars($this);

        $ret = array(
            'type' => self::TYPE,
            'value' => $values,
        );
    }
}

class ReceiptTextline extends ReceiptBase
{
    const TYPE = "textline";

    public $text;
    public $decorations;
}

class ReceiptSeparator extends ReceiptBase
{
    const TYPE = "separator";

    public $caption;
}

class ReceiptSpace extends ReceiptBase
{
    const TYPE = "space";

}


class ReceiptNameValue extends ReceiptBase
{
    const TYPE = "name-value";

    public $name;
    public $value;
    public $decorations;
}
