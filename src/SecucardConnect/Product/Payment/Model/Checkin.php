<?php

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Payment Checkins Api Model class
 */
class Checkin extends BaseModel
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var \DateTime
     */
    public $dob;
}
