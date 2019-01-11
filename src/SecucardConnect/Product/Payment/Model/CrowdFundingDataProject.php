<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * Class CrowdFundingDataProject
 * @package SecucardConnect\Product\Payment\Model
 */
class CrowdFundingDataProject
{
    /**
     * @var int
     */
    public $total_amount = 0;

    /**
     * @var int
     */
    public $total_count = 0;

    /**
     * @var CrowdFundingDataProjectAmount
     */
    public $debit;

    /**
     * @var CrowdFundingDataProjectAmount
     */
    public $credit_card;

    /**
     * @var CrowdFundingDataProjectAmount
     */
    public $prepay;
}
