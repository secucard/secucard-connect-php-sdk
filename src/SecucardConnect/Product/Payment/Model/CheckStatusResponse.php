<?php
/** @noinspection PhpUnused */

namespace SecucardConnect\Product\Payment\Model;

/**
 * Class CheckStatusResponse
 * @package SecucardConnect\Product\Payment\Model
 */
class CheckStatusResponse
{
    /**
     * @var int
     */
    public $status;

    /**
     * @var int
     */
    public $amount;

    /**
     * @var string
     */
    public $currency;
}
