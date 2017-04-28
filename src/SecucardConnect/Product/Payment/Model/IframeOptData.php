<?php

namespace SecucardConnect\Product\Payment\Model;

class IframeOptData
{
    const CESSION_FORMAL = 'formal';
    const CESSION_PERSONAL = 'personal';

    /**
     * @var bool
     */
    public $show_basket;

    /**
     * @var string
     */
    public $basket_title;

    /**
     * @var string
     */
    public $submit_button_title;

    /**
     * @var string
     */
    public $logo_base64;

    /**
     * @var string
     */
    public $cession;
}