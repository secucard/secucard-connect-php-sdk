<?php

namespace SecucardConnect\Product\Payment\Model;


class CcData extends MeanOfPaymentData
{
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

    public function __construct($owner = null, $pan = null, $expiration_date = null, $issuer = null)
    {
        $this->owner = $owner;
        $this->pan = $pan;
        $this->expiration_date = $expiration_date;
        $this->issuer = $issuer;
    }
}
