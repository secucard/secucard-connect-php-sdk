<?php

namespace SecucardConnect\Product\Smart\Model;

/**
 * DeliveryOptionsCollection Api Model class
 */
class DeliveryOptionsCollection
{
    /**
     * @var string string
     */
    public $type = Transaction::DELIVERY_OPTIONS_COLLECTION;

    /**
     * @var string
     */
    public $store_id;

    /**
     * @var string
     */
    public $code;

    /**
     * @var DeliveryOptionsTimeSlot
     */
    public $scheduled_slot;

    /**
     * @var string
     */
    public $delivered_at;
}