<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * Holds parameters to apply when cloning a parent contract.
 * @package SecucardConnect\Product\Payment\Model
 */
class CloneParams
{

    /**
     * @var bool
     */
    public $allow_transactions;

    /**
     * @var string
     */
    public $url_push;

    /**
     * @var Data
     */
    public $payment_data;

    /**
     * @var string
     */
    public $project;

    public function __construct(
        $project = null,
        Data $payment_data = null,
        $allow_transactions = null,
        $url_push = null
    ) {
        $this->allow_transactions = $allow_transactions;
        $this->url_push = $url_push;
        $this->payment_data = $payment_data;
        $this->project = $project;
    }
}