<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\Product\Payment\Service\PaymentService;

/**
 * Operations for the payment.secupaydebits resource.
 * @package SecucardConnect\Product\Payment
 */
class SecupayDebitsService extends PaymentService
{
	/**
	 * @deprecated v1.1.0 Use now onStatusChange($fn).
	 */
	public function onSecupayDebitChanged($fn)
	{
		$this->onStatusChange($fn);
	}
}
