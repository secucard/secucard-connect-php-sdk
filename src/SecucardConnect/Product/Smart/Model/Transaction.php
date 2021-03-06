<?php

namespace SecucardConnect\Product\Smart\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Transactions Api Model class
 *
 */
class Transaction extends BaseModel
{
    const STATUS_CREATED = 'created';
    const STATUS_PROCESSING = 'processing';
    const STATUS_WAITING_FOR_COLLECTION = 'collection';
    const STATUS_WAITING_FOR_SHIPPING = 'received';
    const STATUS_FINISHED = 'finished';
    const STATUS_ABORTED = 'aborted';
    const STATUS_PENDING = 'pending';
    const STATUS_DELETED = 'deleted';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_FAILED = 'failed';
    const STATUS_TIMEOUT = 'timeout';
    const STATUS_APPROVED = 'approved';
    const STATUS_OK = 'ok';

    const DELIVERY_OPTIONS_COLLECTION = 'collection';
    const DELIVERY_OPTIONS_SHIPPING = 'shipping';

    const CHECKOUT_LAST_VISITED_PAGE_CHECKIN = 'checkin_page';
    const CHECKOUT_LAST_VISITED_PAGE_ADDRESS = 'address_page';
    const CHECKOUT_LAST_VISITED_PAGE_PAYMENT_SELECTION = 'payment_selection_page';
    const CHECKOUT_LAST_VISITED_PAGE_PAYMENT_INPUT = 'payment_input_page';
    const CHECKOUT_LAST_VISITED_PAGE_CONFIRMATION = 'confirmation_page';
    const CHECKOUT_LAST_VISITED_PAGE_DELIVERY_OPTIONS = 'delivery_options_page';
    const CHECKOUT_LAST_VISITED_PAGE_SECURITY_CHECK_PAGE = 'security_check_page';
    const CHECKOUT_LAST_VISITED_PAGE_PAYPAL_CHECKOUT = 'paypal_checkout_page';

    //  intent possible values
    const INTENT_DEFAULT = null;
    const INTENT_POS = 'pos';
    const INTENT_SALE = 'sale';
    const INTENT_AUTHORIZATION = 'authorization';
    const INTENT_ORDER = 'order';
    const INTENT_CASHREG = 'cashreg';
    const INTENT_CHECKOUT = 'checkout';

    /**
     * @var Device
     */
    public $device_source;

    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var \DateTime
     */
    public $updated;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $transactionRef;

    /**
     * @var string
     */
    public $merchantRef;

    /**
     * @var Basket
     */
    public $basket;

    /**
     * @var ReceiptLine[]
     */
    public $receipt;

    /**
     * @var ReceiptLine[]
     */
    public $receipt_merchant;

    /**
     * @var boolean
     */
    public $receipt_merchant_print;

    /**
     * @var BasketInfo
     */
    public $basket_info;

    /**
     * @var Ident[]
     */
    public $idents;

    /**
     * @var Device
     */
    public $target_device;

    /**
     * @var \SecucardConnect\Product\General\Model\Contract
     */
    public $contract;

    /**
     * @var string
     */
    public $payment_method;

    /**
     * @var string
     */
    public $last_visited_page;

    /**
     * @var string
     */
    public $error;

    /**
     * @var boolean
     */
    public $is_demo;

    /**
     * @var integer
     */
    public $trans_id;

    /**
     * @var string
     */
    public $iframe_url;

    /**
     * @var CheckoutLinks
     */
    public $checkout_links;

    /**
     * @var \SecucardConnect\Product\Payment\Model\Customer
     */
    public $customer;

    /**
     * @var \SecucardConnect\Product\Payment\Model\Container
     */
    public $container;

    /**
     * @var \SecucardConnect\Product\Payment\Model\Customer
     */
    public $shipping_address;

    /**
     * @var ApplicationContext
     */
    public $application_context;

    /**
     * @var string|null
     */
    public $intent;

    /**
     * @var PaymentLinks
     */
    public $payment_links;

    /**
     * @var BaseDeliveryOptions
     */
    public $delivery_options;

    /**
     * @return array
     */
    public function jsonFilterNullProperties()
    {
        return [
            'device_source',
            'target_device',
            'receipt',
            'receipt_merchant',
            'payment_method',
            'receipt_merchant_print',
            'error'
        ];
    }

    /**
     * @param array $payload
     * @return $this
     */
    public function setDeliveryOptions(array $payload)
    {
        if (!isset($payload['type'])) {
            return $this;
        }

        switch ($payload['type']) {
            case self::DELIVERY_OPTIONS_SHIPPING:
                $this->delivery_options = new DeliveryOptionsShipping();
                break;
            case self::DELIVERY_OPTIONS_COLLECTION:
                $this->delivery_options = new DeliveryOptionsCollection();
                break;
        }

        return $this;
    }
}
