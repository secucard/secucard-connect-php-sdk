<?php

namespace SecucardConnect\Product\General\Model;


use SecucardConnect\Product\Common\Model\BaseModel;

class Event extends BaseModel
{
    const TYPE_CHANGED = 'changed';
    const TYPE_CREATED = 'created';
    // todo: add more types

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $target;

    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var mixed
     */
    public $data;
}


