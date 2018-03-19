<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * Payment Secupayprepays Api Model class
 *
 */
class SecupayPrepay extends Transaction
{
    /**
     * @var string
     */
    public $transfer_purpose;

    /**
     * @var TransferAccount
     */
    public $transfer_account;

}