<?php

namespace SecucardConnect\Product\Smart;

use SecucardConnect\Client\ProductService;

class IdentsService extends ProductService
{
    /**
     * Returns all public information about the Loyalty card
     * @param string $cardNumber The cardnumber of the Loyalty card
     * @param string @var \SecucardConnect\Product\Smart\Model\Ident
     * @return mixed|null|string
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