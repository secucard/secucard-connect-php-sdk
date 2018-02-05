<?php

namespace SecucardConnect\Product\General;


use SecucardConnect\Client\ProductService;
use SecucardConnect\Product\General\Model\Merchant;

/**
 * Provides operations for General/Merchants product.
 * @package SecucardConnect\Product\General
 */
class MerchantsService extends ProductService
{
    /**
     * Getting public data of a merchant.
     *
     * @param string $contractId The merchant general contract id.
     * @return Merchant only public data.
     */
    public function getPublicData($contractId)
    {
        return $this->execute('me', 'getpublicdata', $contractId, null, Merchant::class);
    }

}