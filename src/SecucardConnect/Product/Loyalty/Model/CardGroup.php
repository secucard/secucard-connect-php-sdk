<?php

namespace SecucardConnect\Product\Loyalty\Model;


use SecucardConnect\Product\Common\Model\BaseModel;

class CardGroup extends BaseModel
{
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