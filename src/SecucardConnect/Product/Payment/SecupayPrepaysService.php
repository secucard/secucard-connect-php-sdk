<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\Product\Payment\Service\PaymentService;

/**
 * Operations for the payment.secupayprepay resource.
 * @package SecucardConnect\Product\Payment
 */
class SecupayPrepaysService extends PaymentService
{
    /**
     * @deprecated v1.1.0 Use now onStatusChange($fn).
     * @param callable $fn
     */
    public function onSecupayPrepayChanged($fn)
    {
        $this->onStatusChange($fn);
    }
}
