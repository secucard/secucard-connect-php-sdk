<?php


namespace SecucardConnect\Product\Smart\Model;


/**
 * Class PaymentWizardOptions
 *
 * @author Anton Lunyov <anton.lunyov@blue-veery.com>
 */
class PaymentWizardOptions
{
    /**
     * @var string
     */
    public $payment_hint;

    /**
     * @var string
     */
    public $project_name;

    /**
     * @var string
     */
    public $project_logo;

    /**
     * @var string
     */
    public $submit_button_label;

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
    public $basket_headline;

    /**
     * @var bool
     */
    public $is_basket_shown;

    /**
     * @var string
     */
    public $language_formality;
}