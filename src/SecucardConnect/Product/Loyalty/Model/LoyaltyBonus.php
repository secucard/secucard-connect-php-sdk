<?php

namespace SecucardConnect\Product\Loyalty\Model;

class LoyaltyBonus
{
    /**
     * @var int
     */
    public $missing_sum;

    /**
     * @var \SecucardConnect\Product\Smart\Model\Product[]
     */
    public $bonus_products;
}