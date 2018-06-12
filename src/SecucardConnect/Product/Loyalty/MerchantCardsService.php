<?php

namespace SecucardConnect\Product\Loyalty;


use SecucardConnect\Client\ProductService;

/**
 * Operations for the loyalty/merchantcards resource.
 * @package SecucardConnect\Product\Loyalty
 */
class MerchantCardsService extends ProductService
{
    /**
     * Check the given CSC
     * @param string $cardNumber cardnumber
     * @param int $csc CSC number
     * @return bool|null|
     */
    public function validateCSC($cardNumber, $csc)
    {
        return $this->execute("me", "CheckCsc", null, ["cardnumber" => $cardNumber, "csc" => $csc]);
    }

    /**
     * Check the given passcode
     * @param string $cardNumber cardnumber
     * @param int $pin PIN number
     * @return bool|null
     */
    public function validatePasscode($cardNumber, $pin)
    {
        return $this->execute("me", "CheckPasscode", null, ["cardnumber" => $cardNumber, "pin" => $pin]);
    }
}
