<?php

namespace SecucardConnect\Product\General\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Merchant urls Api Model class
 */
class MerchantUrl extends BaseModel
{
    const URL_TYPE_SUCCESS = 'url_success';
    const URL_TYPE_FAILURE = 'url_failure';
    const URL_TYPE_ABORT = 'url_abort';
    const URL_TYPE_ERROR = 'url_error';

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $url;
}
