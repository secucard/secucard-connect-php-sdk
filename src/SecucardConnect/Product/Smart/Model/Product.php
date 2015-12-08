<?php

namespace SecucardConnect\Product\Smart\Model;



class Product
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $parent;

    /**
     * @var string
     */
    public $articleNumber;

    /**
     * @var string
     */
    public $ean;

    /**
     * @var string
     */
    public $desc;

    /**
     * @var string
     */
    public $quantity;

    /**
     * @var int
     */
    public $priceOne;

    /**
     * @var int
     */
    public $tax;

    /**
     * @var \SecucardConnect\Product\Smart\Model\ProductGroup[]
     */
    public $group;
}