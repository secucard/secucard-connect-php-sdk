<?php
/**
 * Merchants Api Model class
 */

namespace SecucardConnect\Product\General\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\General\Model\LegalDetails;

/**
 * Merchants Api Model class
 *
 */
class Merchant extends BaseModel
{
    /**
     * @var \SecucardConnect\Product\Services\Model\Company
     */
    public $company;

    /**
     * @var LegalDetails[]
     */
    public $legal_details;

    /**
     * @var ContractSettings[]
     */
    public $order_options;

    /**
     * @var ContractSettings[]
     */
    public $payment_contract_conditions;

    /**
     * @var MerchantUrl[]
     */
    public $merchant_urls;
}