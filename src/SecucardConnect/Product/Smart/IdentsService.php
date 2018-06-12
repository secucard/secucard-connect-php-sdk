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
        return $this->execute("notused", "validate", null, [["value" => $cardNumber, "type" => $type]]);
    }
}
