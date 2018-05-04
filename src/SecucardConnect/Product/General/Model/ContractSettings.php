<?php
/**
 * Merchants Api Model class
 */

namespace SecucardConnect\Product\General\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Contract settings and conditions Api Model class
 *
 */
class ContractSettings extends BaseModel
{
    /**
     * @var string
     */
    public $type;

    /**
     * @var bool
     */
    public $enabled;
}