<?php

namespace SecucardConnect\Product\Payment\Service;

use SecucardConnect\Client\ProductService;
use SecucardConnect\Product\Payment\Event\PaymentChanged;

/**
 * Class PaymentService
 * @package SecucardConnect\Product\Payment\Service
 */
abstract class PaymentService extends ProductService implements PaymentServiceInterface
{
	/**
	 * Cancel an existing transaction.
	 * @param string $paymentId The payment transaction id.
	 * @param string $contractId The id of the contract that was used to create this transaction. May be null if the
	 * contract is an parent contract (not cloned).
	 * @return bool TRUE if successful FALSE else.
	 */
	public function cancel($paymentId, $contractId = null)
	{
		$o = [['contract' => $contractId]];
		$res = $this->execute($paymentId, 'cancel', null, $o);

		if(is_object($res)) {
			return (bool)$res->result;
		}

		return (bool)$res['result'];
	}


	/**
	 * Set a callback to be notified when a creditcard has changed. Pass null to remove a previous setting.
	 * @param $fn callable|null Any function which accepts a "Transaction" model class argument.
	 */
	public function onStatusChange($fn)
	{
		$this->registerEventHandler(static::class, $fn === null ? null : new PaymentChanged($fn, $this));
	}

}