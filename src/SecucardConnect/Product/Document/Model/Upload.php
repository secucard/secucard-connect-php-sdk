<?php

namespace SecucardConnect\Product\Document\Model;

use SecucardConnect\Product\Common\Model\BaseModel;


/**
 * Upload Api Model class
 */
class Upload extends BaseModel
{
    /**
     * @var string base64 encoded file content
     */
    public $content;
}

