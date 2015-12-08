<?php
/**
 * Devices Api Model class
 */

namespace SecucardConnect\Product\Smart\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Devices Api Model class
 *
 */
class Device extends BaseModel
{
    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var boolean
     */
    public $online;

    /**
     * @var number
     */
    public $number;

    /**
     * @var string
     */
    public $vendor;

    /**
     * @var string
     */
    public $vendor_uid;

    /**
     * @var string
     */
    public $user_pin;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $type;

    /**
     * @var \SecucardConnect\Product\General\Model\Merchant
     */
    public $merchant;

    /**
     * @var \SecucardConnect\Product\General\Model\Store
     */
    public $store;

    /**
     * @var \SecucardConnect\Product\General\Model\Device
     */
    public $device;
}