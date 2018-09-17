<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * Class Data
 * @package SecucardConnect\Product\Payment\Model
 */
class Data
{
    /**
     * @var string
     */
    public $owner;

    // account data:
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

    // credit card data:
    /**
     * @var string
     */
    public $pan;

    /**
     * @var \DateTime
     */
    public $expiration_date;

    /**
     * @var string
     */
    public $issuer;

    /**
     * Data constructor.
     * @param string $iban
     * @param string $owner
     * @param string $bic
     * @param string $bankname
     * @param string $pan
     * @param string $expiration_date
     * @param string $issuer
     */
    public function __construct(
        $iban = null,
        $owner = null,
        $bic = null,
        $bankname = null,
        $pan = null,
        $expiration_date = null,
        $issuer = null
    ) {
        $this->owner = $owner;
        $this->iban = $iban;
        $this->bic = $bic;
        $this->bankname = $bankname;
        $this->pan = $pan;
        $this->expiration_date = $expiration_date;
        $this->issuer = $issuer;
    }
}
