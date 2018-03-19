<?php

namespace SecucardConnect\Product\Loyalty;

use SecucardConnect\Client\ProductService;

class CardGroupsService extends ProductService
{
    /**
     * Check if a passcode is enabled for this card
     * @param string $cardGroupId CRG_XYZ
     * @param string $transactionType TRANSACTION_TYPE_XYZ
     * @param string $cardNumber Number of the card
     * @return bool|null
     */
    public function checkPasscodeEnabled($cardGroupId, $transactionType, $cardNumber)
    {
        if (!isset($cardGroupId)) {
            throw new \InvalidArgumentException("Parameter [cardGroupId] can not be empty!");
        }

        if (!isset($transactionType)) {
            throw new \InvalidArgumentException("Parameter [transactionType] can not be empty!");
        }

        if (!isset($cardNumber)) {
            throw new \InvalidArgumentException("Parameter [cardNumber] can not be empty!");
        }

        return $this->execute($cardGroupId, "checkPasscodeEnabled", null, ["action" => $transactionType, "cardnumber" => $cardNumber]);
    }
}