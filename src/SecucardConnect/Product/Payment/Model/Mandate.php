<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * SEPA Mandate Api Model class
 *
 */
class Mandate
{
    const MANDATE_STATUS_UNKNOWN = 0;
    const MANDATE_STATUS_REQUEST = 1;
    const MANDATE_STATUS_CANCELLED = 2;
    const MANDATE_STATUS_PRELIMINARY = 3;  // Status of mandate that has been created in the good belief, that the customer will sign the mandate
    const MANDATE_STATUS_OK = 10;

    public $iban;

    public $bic;

    public $type;

    public $identification;

    public $status;

    public $sepa_mandate_id;
}
