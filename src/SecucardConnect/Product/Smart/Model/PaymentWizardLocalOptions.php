<?php


namespace SecucardConnect\Product\Smart\Model;


/**
 * Class PaymentWizardLocalOptions
 *
 * @author Anton Lunyov <anton.lunyov@blue-veery.com>
 */
class PaymentWizardLocalOptions
{
    /**
     * @var string
     */
    public $payment_hint_title;

    /**
     * @var array
     */
    public $payment_hint;

    /**
     * @var string
     */
    public $project_title;

    /**
     * @var string
     */
    public $submit_button_title;

    /**
     * @var string
     */
    public $cancel_button_title;

    /**
     * @var string
     */
    public $language;

    /**
     * @var string
     */
    public $basket_title;

    /**
     * @var bool
     */
    public $hide_disclaimer;

    /**
     * @var bool
     */
    public $has_accepted_disclaimer;
}