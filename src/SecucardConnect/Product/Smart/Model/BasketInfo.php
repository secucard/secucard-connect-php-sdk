<?php

namespace SecucardConnect\Product\Smart\Model;


class BasketInfo
{
    /**
     * @var int
     */
    public $sum;

    /**
     * @var string
     */
    public $currency;

    /**
     * BasketInfo constructor.
     * @param int $sum
     * @param string $currency
     */
    public function __construct($sum = null, $currency = null)
    {
        $this->sum = $sum;
        $this->currency = $currency;
    }
}