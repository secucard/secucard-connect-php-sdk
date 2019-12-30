<?php


namespace SecucardConnect\Product\Smart\Model;


/**
 * Class ApplicationContext
 *
 * @author Anton Lunyov <anton.lunyov@blue-veery.com>
 */
class ApplicationContext
{
    /**
     * @var CheckoutLinks
     */
    public $return_urls;

    /**
     * @var Locks
     */
    public $locks;
}