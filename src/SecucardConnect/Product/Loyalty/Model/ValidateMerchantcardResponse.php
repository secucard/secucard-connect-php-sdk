<?php

namespace SecucardConnect\Product\Loyalty\Model;

class ValidateMerchantcardResponse
{
    /**
     * @var bool Is this merchant card assigned to the merchant
     */
    public $isValid;

    /**
     * @var bool Is this merchant card locked
     */
    public $isLocked;

    /**
     * @var bool Has this merchant card a pass code
     */
    public $hasPasscode;
}