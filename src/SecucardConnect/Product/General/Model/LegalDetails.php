<?php

namespace SecucardConnect\Product\General\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * LegalDetails Api Model class
 */
class LegalDetails extends BaseModel
{
    const LEGAL_DETAILS_LOGO = 'logo';
    const LEGAL_DETAILS_IMPRINT = 'imprint';
    const LEGAL_DETAILS_REVOCATION = 'revocation';
    const LEGAL_DETAILS_TERMS = 'terms';
    const LEGAL_DETAILS_PRIVACY_POLICY = 'policy';

    const LEGAL_DETAILS_LANGUAGE_DE = 'de';
    const LEGAL_DETAILS_LANGUAGE_EN = 'en';

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $content_type;

    /**
     * @var string
     */
    public $language;
}

