<?php

namespace SecucardConnect\Product\Smart\Model;

/**
 * DeliveryOptionsShipping Api Model class
 */
class DeliveryOptionsShipping
{
    /**
     * @var string
     */
    public $type = Transaction::DELIVERY_OPTIONS_SHIPPING;

    /**
     * @var string
     */
    public $shipped_at;

    /**
     * @var string
     */
    public $shipped_by;

    /**
     * @var string
     */
    public $tracking_code;

    /**
     * @var string
     */
    public $invoice_number;
}