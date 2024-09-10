<?php

namespace SecucardConnect\Product\General\Model;

/**
 * Class BankAccount
 * @package SecucardConnect\Product\General\Model
 */
class BankAccount
{
    /**
     * @var string
     */
    public string $owner;

    /**
     * @var string
     */
    public string $iban;

    /**
     * @var string
     */
    public string $bic;

    /**
     * @var string|null
     */
    public ?string $bankname;

    /**
     * CloneParams constructor.
     * @param string $owner
     * @param string $iban
     * @param string $bic
     * @param string|null $bankname
     */
    public function __construct(
        string $owner,
        string $iban,
        string $bic,
        string $bankname = null
    ) {
        $this->owner = $owner;
        $this->iban = $iban;
        $this->bic = $bic;
        $this->bankname = $bankname;
    }
}
