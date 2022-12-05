<?php
/** @noinspection PhpFullyQualifiedNameUsageInspection */
/** @noinspection PhpUnused */

namespace SecucardConnect\Product\Services\Model;

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
     * @var \SecucardConnect\Product\Common\Model\BaseModel[]
     */
    public $assign;
}
