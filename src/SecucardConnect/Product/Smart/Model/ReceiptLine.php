<?php
/**
 * Receipts model class
 */

namespace SecucardConnect\Product\Smart\Model;

/**
 * Class modeling a single receipt line. These lines will be returned when a transaction is completed.
 *
 */
class ReceiptLine
{
    /**
     * The type of this line.
     * @see \SecucardConnect\Product\Smart\Model\ReceiptLineTypes
     * @var string
     */
    public $type;

    /**
     * The actual value of the line.
     * @var ReceiptLineValue
     */
    public $value;

    /**
     * ReceiptLine constructor.
     * @param string $type
     * @param ReceiptLineValue $value
     */
    public function __construct($type = null, ReceiptLineValue $value = null)
    {
        $this->type = $type;
        $this->value = $value;
    }


}



