<?php

namespace SecucardConnect\Product\Payment\Service;

use SecucardConnect\Client\ProductService;
use SecucardConnect\Product\Payment\Event\PaymentChanged;
use SecucardConnect\Product\Payment\Model\Basket;
use SecucardConnect\Product\Payment\Model\Subscription;
use SecucardConnect\Product\Payment\Model\Transaction;

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
     * @param string $contractId The id of the contract that was used to create this transaction. May be null if the
     * contract is an parent contract (not cloned).
     * @param int $amount The amount that you want to refund to the payer. Use '0' for a full refund.
     *
     * @return bool TRUE if successful FALSE else.
     */
    public function cancel($paymentId, $contractId = null, $amount = null)
    {
        $object = [
            [
                'contract' => $contractId,
                'amount' => $amount,
            ]
        ];
        $res = $this->execute($paymentId, 'cancel', null, $object);

        if (is_object($res)) {
            return true;
        }

        return (bool)$res['result'];
    }

    /**
     * Capture a pre-authorized payment transaction.
     *
     * @param string $paymentId The payment transaction id
     * @return bool TRUE if successful, FALSE otherwise.
     */
    public function capture($paymentId)
    {
        $class = $this->resourceMetadata->resourceClass;
        /**
         * @var $object Transaction
         */
        $object = new $class();
        $object->id = $paymentId;
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
     * @return bool TRUE if successful, FALSE otherwise.
     */
    public function updateBasket($paymentId, array $basket)
    {
        $class = $this->resourceMetadata->resourceClass;
        /**
         * @var $object Transaction
         */
        $object = new $class();
        $object->id = $paymentId;
        $object->basket = $basket;
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
     */
    public function reverseAccrual($paymentId)
    {
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
     * Subsequent posting to a approved transaction. This can only be executed once per payment transaction.
     *
     * @param string $paymentId The payment transaction id
     * @param int $amount The new total amount (max. 120% of the old amount)
     * @param Basket[] $basket The new basket items
     * @return bool TRUE if successful, FALSE otherwise.
     */
    public function initSubsequent($paymentId, $amount, array $basket)
    {
        $class = $this->resourceMetadata->resourceClass;
        /**
         * @var $object Transaction
         */
        $object = new $class();
        $object->id = $paymentId;
        $object->amount = $amount;
        $object->basket = $basket;
        $res = $this->execute($paymentId, 'subsequent', null, $object, $class);

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
     * @param string $provider The shipping provider
     * @param string $number The tracking number (comma separated if there is more than one parcel)
     * @param string $invoice_number The invoice number of the shipped order
     * @return bool TRUE if successful, FALSE otherwise.
     */
    public function setShippingInformation($paymentId, $provider, $number, $invoice_number = null)
    {
        $object = [
            [
                'provider' => $provider,
                'number' => $number,
                'invoice_number' => $invoice_number,
            ]
        ];

        $res = $this->updateWithAction($paymentId, 'shippingInformation', null, $object);

        if ($res) {
            return true;
        }

        return false;
    }

    /**
     * Create or update a subscription for a existing transaction
     *
     * @param string $paymentId The payment transaction id
     * @param string $purpose The purpose of the subscription
     * @return bool TRUE if successful, FALSE otherwise.
     */
    public function updateSubscription($paymentId, $purpose)
    {
        $class = $this->resourceMetadata->resourceClass;
        /**
         * @var $object Transaction
         */
        $object = new $class();
        $object->id = $paymentId;
        $object->subscription = new Subscription();
        $object->subscription->purpose = $purpose;
        $res = $this->updateWithAction($paymentId, 'subscription', null, $object, $class);

        if ($res) {
            return true;
        }

        return false;
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