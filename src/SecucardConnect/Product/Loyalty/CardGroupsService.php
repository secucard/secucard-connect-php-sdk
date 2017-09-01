<?php

namespace SecucardConnect\Product\Loyalty;


use SecucardConnect\Client\ProductService;

class CardGroupsService extends ProductService
{
    /**
     * Check if a passcode is enabled for this card
     * @param string $cardGroupId CRG_XYZ
     * @param string $transactionType FORM_TRANSACTION_XYZ
     * @param string $cardNumber Number of the card
     * @return bool|null
     */
    public function checkPasscodeEnabled($cardGroupId, $transactionType, $cardNumber) {
        return $this->execute($cardGroupId, "checkPasscodeEnabled", null, ["action" => $transactionType, "cardnumber" => $cardNumber]);
    }
}