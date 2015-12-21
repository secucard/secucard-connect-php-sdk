<?php

namespace SecucardConnect\Product\Smart\Model;

/**
 * Defines possible decorations of receipt line texts.
 * @package SecucardConnect\Product\Smart\Model
 */
final class ReceiptLineDecorations
{
    /**
     * Emphasize the text.
     */
    const IMPORTANT = "important";

    /**
     *  Left align the text.
     */
    const ALIGN_LEFT = "align_left";

    /**
     *  Right align the text.
     */
    const ALIGN_RIGHT = "align_right";
}