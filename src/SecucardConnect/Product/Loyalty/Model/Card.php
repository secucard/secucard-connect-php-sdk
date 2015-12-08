<?php
/**
 * Cards Api Model class
 */

namespace SecucardConnect\Product\Loyalty\Model;

use DateTime;
use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\General\Model\Account;

/**
 * Cards Api Model class
 *
 */
class Card extends BaseModel
{
    /**
     * @var string
     */
    public $cardnumber;

    /**
     * @var \DateTime
     */
    public $created;


    /**
     * @var Account
     */
    public $account;

}