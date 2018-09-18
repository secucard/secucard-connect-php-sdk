<?php

namespace SecucardConnect\Product\Smart;

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
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function getCardInfo($cardNumber, $type)
    {
        if (empty($cardNumber)) {
            throw new \InvalidArgumentException("Parameter [cardNumber] can not be empty!");
        }

        if (empty($type)) {
            throw new \InvalidArgumentException("Parameter [type] can not be empty!");
        }

        return $this->execute("notused", "validate", null, [["value" => $cardNumber, "type" => $type]]);
    }
}
