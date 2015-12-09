<?php
/**
 * Payment Secupaydebits Api Model class
 */

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Common\Model\MainModel;

/**
 * Payment SecupayDebits Api Model class
 *
 */
class SecupayDebit extends Transaction
{
    /**
     * @var \SecucardConnect\Product\Payment\Model\Container
     */
    public $container;
}