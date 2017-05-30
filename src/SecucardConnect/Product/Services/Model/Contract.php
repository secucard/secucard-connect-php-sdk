<?php

namespace SecucardConnect\Product\Services\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\General\Model\Merchant;

/**
 * Ident contracts Api Model class
 */
class Contract extends BaseModel
{
    /**
     * @var string
     */
    public $redirect_url_success;

    /**
     * @var string
     */
    public $redirect_url_failed;

    /**
     * @var string
     */
    public $push_url;

    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var Merchant
     */
    public $merchant;
}