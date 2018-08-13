<?php
/**
 * Transactions Api Model class
 */

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
    const STATUS_FAILED = 'failed';
    const STATUS_TIMEOUT = 'timeout';
    const STATUS_APPROVED = 'approved';
    const STATUS_OK = 'ok';

    const ORDER_OPTION_COLLECTION = 'collection';
    const ORDER_OPTION_SHIPPING = 'shipping';

    const CHECKOUT_LAST_VISITED_PAGE_CHECKIN = 'checkin_page';
    const CHECKOUT_LAST_VISITED_PAGE_ADDRESS = 'address_page';
    const CHECKOUT_LAST_VISITED_PAGE_PAYMENT_SELECTION = 'payment_selection_page';
    const CHECKOUT_LAST_VISITED_PAGE_PAYMENT_INPUT = 'payment_input_page';
    const CHECKOUT_LAST_VISITED_PAGE_CONFIRMATION = 'confirmation_page';
    const CHECKOUT_LAST_VISITED_PAGE_DELIVERY_OPTIONS = 'delivery_options_page';

    /**
     * @var \SecucardConnect\Product\Smart\Model\Device
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
     * @var \SecucardConnect\Product\Smart\Model\ReceiptLine[]
     */
    public $receipt;

    /**
     * @var \SecucardConnect\Product\Smart\Model\ReceiptLine[]
     */
    public $receipt_merchant;

    /**
     * @var boolean
     */
    public $receipt_merchant_print;

    /**
     * @var \SecucardConnect\Product\Smart\Model\BasketInfo
     */
    public $basket_info;

    /**
     * @var \SecucardConnect\Product\Smart\Model\Ident[]
     */
    public $idents;

    /**
     * @var \SecucardConnect\Product\Smart\Model\Device
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
    public $order_option;

    /**
     * @var string
     */
    public $last_visited_page;

    /**
     * @var PickupOptions
     */
    public $pickup_options;

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
}
