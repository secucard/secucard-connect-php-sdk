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
     * @param string $cardNumber card number
     * @param int $csc CSC number
     * @return bool|null
     */
    public function validateCSC($cardNumber, $csc)
    {
        if (empty($cardNumber)) {
            throw new \InvalidArgumentException("Parameter [cardNumber] can not be empty!");
        }

        if (empty($csc)) {
            throw new \InvalidArgumentException("Parameter [csc] can not be empty!");
        }

        return $this->execute("me", "CheckCsc", null, ["cardnumber" => $cardNumber, "csc" => $csc]);
    }

    /**
     * Check the given passcode
     * @param string $cardNumber card number
     * @param int $pin PIN number
     * @return bool|null
     */
    public function validatePasscode($cardNumber, $pin)
    {
        if (empty($cardNumber)) {
            throw new \InvalidArgumentException("Parameter [cardNumber] can not be empty!");
        }

        if (empty($pin)) {
            throw new \InvalidArgumentException("Parameter [pin] can not be empty!");
        }

        return $this->execute("me", "CheckPasscode", null, ["cardnumber" => $cardNumber, "pin" => $pin]);
    }
}