<?php


namespace SecucardConnect\Product\Smart\Model;


/**
 * Class PaymentWizardOptions
 *
 * @author Anton Lunyov <anton.lunyov@blue-veery.com>
 */
class PaymentWizardContractOptions
{
    /**
     * @var array
     */
    public $payment_hint_title;

    /**
     * @var string
     */
    public $project_title;

    /**
     * @var string
     */
    public $project_logo;

    /**
     * @var string
     */
    public $submit_button_title;

    /**
     * @var string
     */
    public $primary_colour;

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
    public $is_basket_shown;

    /**
     * @var string
     */
    public $language_formality;
}