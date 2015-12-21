<?php

namespace SecucardConnect\Product\Smart\Model;

/**
 * Defines possible types of receipt lines.
 * @package SecucardConnect\Product\Smart\Model
 */
final class ReceiptLineTypes
{
    /**
     *  A horizontal separator like a line. May have caption.
     */
    const SEPARATOR = 'separator';

    /**
     * Empty line. No text.
     *
     */
    const SPACE = 'space';

    /**
     * Normal line of text.
     */
    const TEXT_LINE = 'textline';

    /**
     * A name:value pair, may displayed as 2 columns.
     */
    const NAME_VALUE = 'name-value';

}