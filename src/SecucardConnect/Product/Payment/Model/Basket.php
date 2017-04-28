<?php

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Basket Data Model class
 *
 */
class Basket extends BaseModel
{
	const ITEM_TYPE_ARTICLE = 'article';
	const ITEM_TYPE_SHIPPING = 'shipping';
	const ITEM_TYPE_DONATION = 'donation';
	const ITEM_TYPE_STAKEHOLDER_PAYMENT = 'stakeholder_payment';

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

    /**
     * @deprecated used/needed only for migrations from the old flex.API
     * @var string
     */
    public $apikey;
}