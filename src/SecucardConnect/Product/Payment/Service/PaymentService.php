<?php

namespace SecucardConnect\Product\Payment\Service;

use GuzzleHttp\Exception\GuzzleException;
use SecucardConnect\Client\ApiError;
use SecucardConnect\Client\AuthError;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\MissingParamsError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Product\Payment\Event\PaymentChanged;
use SecucardConnect\Product\Payment\Model\Basket;
use SecucardConnect\Product\Payment\Model\Transaction;
use SecucardConnect\Product\Payment\TransactionsService;

/**
 * Class PaymentService
 * @package SecucardConnect\Product\Payment\Service
 */
abstract class PaymentService extends ProductService implements PaymentServiceInterface
{
    /**
     * Cancel or Refund an existing transaction.
     * Currently, partial refunds are are not allowed for all payment products.
     *
     * @param string $paymentId The payment transaction id.
     * @param string $contractId The id of the contract that was used to create this transaction.
     * @param int $amount The amount that you want to refund to the payer. Use '0' for a full refund.
     * @param bool $reduceStakeholderPayment TRUE if you want to change the amount of the stakeholder positions too (on partial refund)
     *
     * @return array ['result', 'demo', 'new_trans_id', 'remaining_amount', 'refund_waiting_for_payment']
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws MissingParamsError
     */
    public function cancel($paymentId, $contractId = null, $amount = null, $reduceStakeholderPayment = false)
    {
        if (empty($paymentId)) {
            throw new MissingParamsError('paymentId', __METHOD__);
        }

        $object = [
            'contract' => $contractId,
            'amount' => $amount,
            'reduce_stakeholder_payment' => $reduceStakeholderPayment
        ];
        $res = $this->execute($paymentId, 'cancel', null, $object);

        if (is_object($res)) {
            return $res;
        }

        return $res;
    }

    /**
     * Capture a pre-authorized payment transaction.
     *
     * @param string $paymentId The payment transaction id
     * @param string $contractId The id of the contract that was used to create this transaction.
     * @return bool TRUE if successful, FALSE otherwise.
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws MissingParamsError
     */
    public function capture($paymentId, $contractId = null)
    {
        if (empty($paymentId)) {
            throw new MissingParamsError('paymentId', __METHOD__);
        }

        $class = $this->resourceMetadata->resourceClass;

        $object = [
            'contract' => $contractId,
        ];

        $res = $this->execute($paymentId, 'capture', null, $object, $class);

        if ($res) {
            return true;
        }

        return false;
    }

    /**
     * Add additional basket items to the payment transaction. F.e. for adding stakeholder payment items.
     *
     * @param string $paymentId The payment transaction id
     * @param Basket[] $basket
     * @param string $contractId The id of the contract that was used to create this transaction.
     * @return bool TRUE if successful, FALSE otherwise.
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws MissingParamsError
     */
    public function updateBasket($paymentId, $basket, $contractId = null)
    {
        if (empty($paymentId)) {
            throw new MissingParamsError('paymentId', __METHOD__);
        }

        if (empty($basket) || !is_array($basket)) {
            throw new MissingParamsError('basket', __METHOD__);
        }

        $class = $this->resourceMetadata->resourceClass;
        /**
         * @var $object Transaction
         */
        $object = new $class();
        $object->id = $paymentId;
        $object->basket = $basket;
        $object->contract = $contractId;
        $res = $this->updateWithAction($paymentId, 'basket', null, $object, $class);

        if ($res) {
            return true;
        }

        return false;
    }

    /**
     * Remove the accrual flag of an existing payment transaction.
     *
     * @param string $paymentId The payment transaction id
     * @return bool
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws MissingParamsError
     */
    public function reverseAccrual($paymentId)
    {
        if (empty($paymentId)) {
            throw new MissingParamsError('paymentId', __METHOD__);
        }

        $class = $this->resourceMetadata->resourceClass;
        /**
         * @var $object Transaction
         */
        $object = new $class();
        $object->id = $paymentId;
        $object->accrual = false;
        $res = $this->updateWithAction($paymentId, 'accrual', null, $object, $class);

        if ($res) {
            return true;
        }

        return false;
    }

    /**
     * Add some shipping information, like the shipping provider (carrier) or a tracking number for the parcel.
     * For invoice payment transactions this will also capture the transaction (set the shipping date of an invoice).
     *
     * @param string $paymentId The payment transaction id
     * @param string $carrier The Shipping Service Provider
     * @param string $tracking_id The tracking number (comma separated if there is more than one parcel)
     * @param string $invoice_number The invoice number of the shipped order
     * @return bool TRUE if successful, FALSE otherwise.
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws MissingParamsError
     */
    public function setShippingInformation($paymentId, $carrier, $tracking_id, $invoice_number = null)
    {
        $service = new TransactionsService();
        return $service->setShippingInformation($paymentId, $carrier, $tracking_id, $invoice_number);
    }

    /**
     * Set a callback to be notified when a creditcard has changed. Pass null to remove a previous setting.
     * @param callable|null $fn Any function which accepts a "Transaction" model class argument.
     */
    public function onStatusChange($fn)
    {
        $this->registerEventHandler(static::class, $fn === null ? null : new PaymentChanged($fn, $this));
    }

}
