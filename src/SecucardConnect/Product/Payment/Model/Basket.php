<?php

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Basket Data Model class
 *
 */
class Basket extends BaseModel
{
    /**
     * @var int
     */
    public $quantity;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $ean;

    /**
     * @var int
     */
    public $tax;

    /**
     * @var int
     */
    public $total;

    /**
     * @var int
     */
    public $price;

    /**
     * @var string
     */
    public $contract_id;

    /**
     * @var string
     */
    public $model;

    /**
     * @var string
     */
    public $article_number;

    /**
     * @var string
     */
    public $item_type;
}