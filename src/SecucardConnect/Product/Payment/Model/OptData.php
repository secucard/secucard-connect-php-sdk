<?php

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * RedirectUrl Data Model class
 *
 */
class OptData extends BaseModel
{
    /**
     * @var bool
     */
    public $has_accepted_disclaimer = false;

    /**
     * @var bool
     */
    public $hide_disclaimer = false;
}