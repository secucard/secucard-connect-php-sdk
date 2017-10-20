<?php

namespace SecucardConnect\Product\Loyalty\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

class LoyaltyBonus extends BaseModel
{
    /**
     * @var number
     */
    public $missing_sum;

    /**
     * @var \SecucardConnect\Product\Smart\Model\Product[]
     */
    public $bonus_products;
}