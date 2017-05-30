<?php

namespace SecucardConnect\Product\Services\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Task Api Model class
 */
class Task
{
    /**
     * @var string
     */
    public $task_id;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $type_info;

    /**
     * @var string
     */
    public $status;

    /**
     * @var BaseModel[]
     */
    public $assign;
}