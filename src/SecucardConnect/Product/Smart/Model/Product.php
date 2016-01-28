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
     * @var int
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

    /**
     * Product constructor.
     * @param int $id
     * @param int $parent
     * @param string $articleNumber
     * @param string $ean
     * @param string $desc
     * @param int $quantity
     * @param int $priceOne
     * @param int $tax
     * @param ProductGroup[] $group
     */
    public function __construct(
        $id = null,
        $parent = null,
        $articleNumber = null,
        $ean = null,
        $desc = null,
        $quantity = null,
        $priceOne = null,
        $tax = null,
        array $group = null
    ) {
        $this->id = $id;
        $this->parent = $parent;
        $this->articleNumber = $articleNumber;
        $this->ean = $ean;
        $this->desc = $desc;
        $this->quantity = $quantity;
        $this->priceOne = $priceOne;
        $this->tax = $tax;
        $this->group = $group;
    }


}