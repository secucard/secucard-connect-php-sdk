<?php
/** @noinspection PhpUnused */

namespace SecucardConnect\Product\Payment\Model;

/**
 * Class CrowdFundingData
 * @package SecucardConnect\Product\Payment\Model
 */
class CrowdFundingData
{
    /**
     * @var CrowdFundingDataProject
     */
    public $project;

    /**
     * @var int
     */
    public $deposited_amount = 0;

    /**
     * @var int
     */
    public $paid_out = 0;

    /**
     * @var int
     */
    public $deducted_amount = 0;

    /**
     * @var CrowdFundingDataOpen
     */
    public $open;
}
