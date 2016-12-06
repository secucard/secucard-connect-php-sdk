<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\Product\Payment\Service\PaymentService;

/**
 * Operations for the payment.secupayinvoice resource.
 * @package SecucardConnect\Product\Payment
 */
class SecupayInvoicesService extends PaymentService
{
	/**
	 * @deprecated v1.1.0 Use now onStatusChange($fn).
	 */
	public function onSecupayInvoiceChanged($fn)
	{
		$this->onStatusChange($fn);
	}
}
