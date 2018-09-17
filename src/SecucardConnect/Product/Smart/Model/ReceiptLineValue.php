<?php

namespace SecucardConnect\Product\Smart\Model;

/**
 * Class ReceiptLineValue
 * @package SecucardConnect\Product\Smart\Model
 */
class ReceiptLineValue
{
    /**
     * @var string
     */
    public $caption;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $value;

    /**
     * The decorations of the $text property.
     * @see \SecucardConnect\Product\Smart\Model\ReceiptLineDecorations for possible values.
     * @var string[]
     */
    public $decoration;

    /**
     * ReceiptLineValue constructor.
     *
     * @param string|null $caption
     * @param string|null $text
     * @param string|null $name
     * @param string|null $value
     * @param array|null $decoration
     */
    public function __construct($caption = null, $text = null, $name = null, $value = null, array $decoration = null)
    {
        $this->caption = $caption;
        $this->text = $text;
        $this->name = $name;
        $this->value = $value;
        $this->decoration = $decoration;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return (string)print_r($this, true);
    }
}
