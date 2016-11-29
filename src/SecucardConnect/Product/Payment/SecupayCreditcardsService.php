<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\Product\Payment\Service\PaymentService;

/**
 * Operations for the payment.secupaycreditcard resource.
 * @package SecucardConnect\Product\Payment
 */
class SecupayCreditcardsService extends PaymentService
{
    /**
     * @deprecated v1.1.0 Use now onStatusChange($fn).
     */
    public function onSecupayCreditcardChanged($fn)
    {
        $this->onStatusChange($fn);
    }
}

