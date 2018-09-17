<?php

namespace SecucardConnect\Product\Smart;


use GuzzleHttp\Exception\GuzzleException;
use SecucardConnect\Client\ApiError;
use SecucardConnect\Client\AuthError;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;

/**
 * Class IdentsService
 * @package SecucardConnect\Product\Smart
 */
class IdentsService extends ProductService
{
    /**
     * Returns all public information about the Loyalty card
     * @param string $cardNumber The cardnumber of the Loyalty card
     * @param string $type
     * @return mixed|null|string
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function getCardInfo($cardNumber, $type)
    {
        return $this->execute("notused", "validate", null, [["value" => $cardNumber, "type" => $type]]);
    }
}
