<?php


namespace SecucardConnect\Product\General\Model;


/**
 * OrderOptions Api Model class
 */
class OrderOptions
{
    /**
     * @var ShippingDeliveryConfiguration
     */
    public $shipping;

    /**
     * @var CollectionDeliveryConfiguration
     */
    public $collection;
}