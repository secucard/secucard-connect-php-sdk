<?php

namespace SecucardConnect\Product\Payment\Model;

class Data
{
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
     */
    public $bankname;

    public function __construct($iban = null, $owner = null, $bic = null, $bankname = null)
    {
        $this->owner = $owner;
        $this->iban = $iban;
        $this->bic = $bic;
        $this->bankname = $bankname;
    }
}
