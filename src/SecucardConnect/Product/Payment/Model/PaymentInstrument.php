<?php

namespace SecucardConnect\Product\Payment\Model;

/**
 * Class PaymentInstrument
 * @package SecucardConnect\Product\Payment\Model
 */
class PaymentInstrument
{
    const PAYMENT_INSTRUMENT_TYPE_BANK_ACCOUNT = 'bank_account';
    const PAYMENT_INSTRUMENT_TYPE_CREDIT_CARD = 'credit_card';

    /**
     * Holds the payment instrument data
     *
     * @var array
     */
    public $data;

    /**
     * The type of the payment instrument data, like: 'bank_account' or 'credit_card'
     *
     * @var string
     */
    public $type;

    /**
     * Store the payment instrument data for a bank account
     *
     * @param string $owner The owner of the bank account
     * @param string $iban The International Bank Account Number (IBAN)
     * @param string $bic The Business Identifier Codes (BIC)
     * @param string $bankname The name of the bank institute
     *
     * @return self
     */
    public function createBankAccount($owner, $iban, $bic = null, $bankname = null)
    {
        $iban = str_replace(' ', '', $iban);
        $iban = substr_replace($iban, str_repeat("X", strlen($iban) - 8), 4, -4);

        $this->type = self::PAYMENT_INSTRUMENT_TYPE_BANK_ACCOUNT;
        $this->data = [
            'owner' => $owner,
            'iban' => $iban,
            'bic' => $bic,
            'bankname' => $bankname
        ];

        return $this;
    }

    /**
     * Store the payment instrument data for a bank account
     *
     * @param string $owner The owner of the credit card
     * @param string $pan The Primary Account Number (PAN)
     * @param string $expiration_date The date till the payment instrument is valid at longest
     * @param string $issuer The name of the issuing network, f.e. 'visa'
     *
     * @return self
     */
    public function createCreditCard($owner, $pan, $expiration_date, $issuer = null)
    {
        $pan = str_replace(' ', '', $pan);
        $pan = substr_replace($pan, str_repeat("X", 8), 4, 8);

        $this->type = self::PAYMENT_INSTRUMENT_TYPE_CREDIT_CARD;
        $this->data = [
            'owner' => $owner,
            'pan' => $pan,
            'expiration_date' => date('Y-m-t\T23:59:59', strtotime($expiration_date)),
            'issuer' => $issuer
        ];

        return $this;
    }

    /**
     * Returns the payment instrument data for a credit card
     *
     * @return array|null
     */
    public function getBankAccount()
    {
        if ($this->type == self::PAYMENT_INSTRUMENT_TYPE_BANK_ACCOUNT && !empty($this->data)) {
            return $this->data;
        }

        return null;
    }

    /**
     * Returns the payment instrument data for a credit card
     *
     * @return array|null
     */
    public function getCreditCard()
    {
        if ($this->type == self::PAYMENT_INSTRUMENT_TYPE_CREDIT_CARD && !empty($this->data)) {
            return $this->data;
        }

        return null;
    }
}
