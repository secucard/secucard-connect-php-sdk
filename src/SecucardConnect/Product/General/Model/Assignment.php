<?php

namespace SecucardConnect\Product\General\Model;


/**
 * Class Assignment
 * @package SecucardConnect\Product\General\Model
 */
class Assignment
{
    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var string
     */
    public $type;

    /**
     * @var boolean
     */
    public $owner;

    /**
     * @var \SecucardConnect\Product\General\Model\AccountDevice
     */
    public $assign;
}
