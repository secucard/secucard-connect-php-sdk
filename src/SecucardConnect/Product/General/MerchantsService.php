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
     * @param string $merchantId The merchant id.
     * @return Merchant only public data.
     */
    public function getPublicData($merchantId)
    {
        return $this->execute($merchantId, 'getpublicdata', null, null, Merchant::class);
    }

}