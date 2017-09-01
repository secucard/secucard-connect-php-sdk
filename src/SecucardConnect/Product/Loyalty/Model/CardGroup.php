<?php

namespace SecucardConnect\Product\Loyalty\Model;


use SecucardConnect\Product\Common\Model\BaseModel;

class CardGroup extends BaseModel
{
    const TRANSACTION_TYPE_CHARGE = 'charge';
    const TRANSACTION_TYPE_DISCHARGE = 'discharge';
    const TRANSACTION_TYPE_SALE_REVENUE = 'sale_revenue';
    const TRANSACTION_TYPE_CHARGE_POINTS = 'charge_points';
    const TRANSACTION_TYPE_DISCHARGE_POINTS = 'discharge_points';
    const TRANSACTION_TYPE_CASHREPORT = 'cashreport';

    /**
     * @var string
     */
    public $display_name;

    /**
     * @var string
     */
    public $display_name_raw;

    /**
     * @var int
     */
    public $stock_warn_limit;

    /**
     * @var string
     */
    public $picture;
}