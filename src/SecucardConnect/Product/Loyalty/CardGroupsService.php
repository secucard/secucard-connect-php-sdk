<?php

namespace SecucardConnect\Product\Loyalty;

use SecucardConnect\Client\ApiError;
use SecucardConnect\Client\AuthError;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;

/**
 * Class CardGroupsService
 * @package SecucardConnect\Product\Loyalty
 */
class CardGroupsService extends ProductService
{
    /**
     * Check if a passcode is enabled for this card
     * @param string $cardGroupId CRG_XYZ
     * @param string $transactionType TRANSACTION_TYPE_XYZ
     * @param string $cardNumber Number of the card
     * @return bool|null
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function checkPasscodeEnabled($cardGroupId, $transactionType, $cardNumber)
    {
        if (empty($cardGroupId)) {
            throw new \InvalidArgumentException("Parameter [cardGroupId] can not be empty!");
        }

        if (empty($transactionType)) {
            throw new \InvalidArgumentException("Parameter [transactionType] can not be empty!");
        }

        if (empty($cardNumber)) {
            throw new \InvalidArgumentException("Parameter [cardNumber] can not be empty!");
        }

        return $this->execute($cardGroupId, "checkPasscodeEnabled", null, ["action" => $transactionType, "cardnumber" => $cardNumber]);
    }
}
