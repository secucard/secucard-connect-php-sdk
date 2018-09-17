<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * RedirectUrl Data Model class
 *
 */
class RedirectUrl
{
    /**
     * The url for redirect the customer back to the shop after a successful payment checkout
     *
     * @var string
     */
    public $url_success;

    /**
     * The url for redirect the customer back to the shop after a failure (or on cancel) on the payment checkout page
     *
     * @var string
     */
    public $url_failure;

    /**
     * The url for redirect the customer to the payment checkout page
     *
     * @var string
     */
    public $iframe_url;

    /**
     * Your endpoint to receive push notifications (when the status of the payment transaction will be changed).
     *
     * @var string
     */
    public $url_push;
}
