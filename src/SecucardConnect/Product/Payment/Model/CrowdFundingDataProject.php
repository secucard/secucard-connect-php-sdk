<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * Class CrowdFundingDataProject
 * @package SecucardConnect\Product\Payment\Model
 */
class CrowdFundingDataProject
{
    /**
     * @var string
     */
    public $currency = 'EUR';

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

    /**
     * @var CrowdFundingDataProjectAmount
     */
    public $sofort;

    /**
     * @var CrowdFundingDataProjectAmount
     */
    public $twint;
}
