<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * Class CrowdFundingDataOpen
 * @package SecucardConnect\Product\Payment\Model
 */
class CrowdFundingDataOpen
{
    /**
     * @var int
     */
    public $total = 0;

    /**
     * @var CrowdFundingDataOpenDetail
     */
    public $outside_cancellation_period;

    /**
     * @var CrowdFundingDataOpenDetail
     */
    public $inside_cancellation_period;
}
