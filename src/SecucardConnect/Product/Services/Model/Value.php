<?php


namespace SecucardConnect\Product\Services\Model;


class Value
{
    const STATUS_NEW = "NEW";
    const STATUS_MATCH = "MATCH";

    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $original;

}