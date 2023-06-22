<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * Class TransferAccount
 * @package SecucardConnect\Product\Payment\Model
 */
class TransferAccount
{
    /**
     * @var string
     * @deprecated use $owner
     */
    public $account_owner;

    /**
     * @var string
     * @deprecated use $iban
     */
    public $accountnumber;

    /**
     * @var string
     */
    public $owner;

    /**
     * @var string
     */
    public $iban;

    /**
     * @var string
     */
    public $bic;

    /**
     * @var string
     * @deprecated use $bic
     */
    public $bankcode;

    /**
     * @var string
     */
    public $bankname;

}
