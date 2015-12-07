<?php

namespace SecucardConnect\Product\General\Model;


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
     * @var AccountDevices
     */
    public $assign;
}