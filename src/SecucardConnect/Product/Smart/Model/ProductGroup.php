<?php

namespace SecucardConnect\Product\Smart\Model;


class ProductGroup
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $desc;

    /**
     * @var int
     */
    public $level;

    /**
     * ProductGroup constructor.
     * @param string $id
     * @param string $desc
     * @param int $level
     */
    public function __construct($id = null, $desc = null, $level = null)
    {
        $this->id = $id;
        $this->desc = $desc;
        $this->level = $level;
    }


}