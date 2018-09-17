<?php

namespace SecucardConnect\Product\Smart\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Routings Api Model class
 */
class Routing extends BaseModel
{
    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $picture;

    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var \SecucardConnect\Product\General\Model\Store
     */
    public $store;

    /**
     * @var \SecucardConnect\Product\Smart\Model\Device
     */
    public $assign;
}
