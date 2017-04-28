<?php

namespace SecucardConnect\Product\Payment\Model;

class CreateSubContractResponse
{
    /**
     * @var string
     */
    public $apikey;

    /**
     * @var Contract
     */
    public $contract;

    /**
     * @var \SecucardConnect\Product\Payment\Model\Data
     */
    public $payin_account;

    /**
     * @var string
     * @deprecated TODO remove
     */
    public $contract_id;
}