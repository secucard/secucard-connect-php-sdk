<?php

namespace SecucardConnect\Product\Loyalty;


use GuzzleHttp\Exception\GuzzleException;
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
     * @param string $transactionType FORM_TRANSACTION_XYZ
     * @param string $cardNumber Number of the card
     * @return bool|null
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function checkPasscodeEnabled($cardGroupId, $transactionType, $cardNumber)
    {
        return $this->execute($cardGroupId, "checkPasscodeEnabled", null, ["action" => $transactionType, "cardnumber" => $cardNumber]);
    }
}
