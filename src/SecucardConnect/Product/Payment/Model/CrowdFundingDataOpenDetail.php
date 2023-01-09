<?php
/** @noinspection PhpUnused */

namespace SecucardConnect\Product\Payment\Model;

/**
 * Class CrowdFundingDataOpenDetail
 * @package SecucardConnect\Product\Payment\Model
 */
class CrowdFundingDataOpenDetail
{
    /**
     * @var int
     */
    public $total = 0;

    /**
     * @var int|null
     */
    public $debit = null;

    /**
     * @var int|null
     */
    public $credit_card = null;

    /**
     * @var int|null
     */
    public $prepay = null;

    /**
     * @var int|null
     */
    public $sofort = null;

    /**
     * @var int|null
     */
    public $twint = null;
}
