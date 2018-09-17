<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * Class CreateSubContractRequest
 * @package SecucardConnect\Product\Payment\Model
 */
class CreateSubContractRequest
{
    /**
     * @var \SecucardConnect\Product\Common\Model\Contact
     */
    public $contact;

    /**
     * @var string
     */
    public $project;

    /**
     * @var \SecucardConnect\Product\Payment\Model\Data
     */
    public $payout_account;

    /**
     * @var IframeOptData
     */
    public $iframe_opts;

    /**
     * @var bool
     */
    public $payin_account;
}
