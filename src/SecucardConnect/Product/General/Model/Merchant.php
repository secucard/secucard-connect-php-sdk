<?php
/**
 * Merchants Api Model class
 */

namespace SecucardConnect\Product\General\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Services\Model\Company;
use SecucardConnect\Product\General\Model\LegalDetails;

/**
 * Merchants Api Model class
 *
 */
class Merchant extends BaseModel
{
    /**
     * @var Company
     */
    public $company;

    /**
     * @var LegalDetails[]
     */
    public $legal_details;
}