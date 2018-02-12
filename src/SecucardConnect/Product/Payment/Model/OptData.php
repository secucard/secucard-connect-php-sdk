<?php

namespace SecucardConnect\Product\Payment\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * OptData Data Model class
 */
class OptData extends BaseModel
{
    const LANGUAGE_DE_DE = 'de_DE';
    const LANGUAGE_EN_US = 'en_US';
    const LANGUAGE_NL_NL = 'nl_NL';
    const LANGUAGE_FR_FR = 'fr_FR';
    const LANGUAGE_IT_IT = 'it_IT';
    const LANGUAGE_RU_UA = 'ru_UA';
    const LANGUAGE_RU_RU = 'ru_RU';

    /**
     * @var bool
     */
    public $has_accepted_disclaimer = false;

    /**
     * @var bool
     */
    public $hide_disclaimer = false;

    /**
     * Define the user language of the payment iframe
     * Possible values are:
     * - "en_US"
     * - "de_DE"
     * - "nl_NL"
     * - "fr_FR"
     * - "it_IT"
     * - "ru_UA"
     * - "ru_RU"
     *
     * @var string
     */
    public $language = self::LANGUAGE_DE_DE;

    /**
     * The label of the headline above the basket
     * Default for DE: "Rechnungsübersicht", for EN: "Overview"
     *
     * @var string
     */
    public $basket_title;

    /**
     * The label of the payment hint
     * Default for DE: "Hinweis", for EN: "Hint"
     *
     * @var string
     */
    public $payment_hint_title;

    /**
     * The label of the submit button
     * Default for DE: "Kauf bestätigen", for EN: "Submit Payment"
     *
     * @var string
     */
    public $submit_button_title;

    /**
     * The label of the cancel button
     * Default for DE: "abbrechen", for EN: "Cancel Payment"
     *
     * @var string
     */
    public $cancel_button_title;

    /**
     * The name of the project
     *
     * @var string
     */
    public $project_title;
}