<?php

namespace SecucardConnect\Product\Services;

use SecucardConnect\Client\ApiError;
use SecucardConnect\Client\AuthError;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Client\QueryParams;
use SecucardConnect\Product\Common\Model\BaseCollection;

/**
 * Operations for the services/identresults resource.
 * @package SecucardConnect\Product\Services
 */
class IdentResultsService extends ProductService
{
    /**
     * Returns an array of IdentResult instances for a given array of IdentRequest ids.
     * @param array $ids The request ids.
     * @return BaseCollection The obtained results.
     * @throws ClientError
     * @throws ApiError
     * @throws AuthError
     */
    public function getListByRequestIds($ids)
    {
        $parts = [];
        foreach ($ids as $id) {
            $parts[] = 'request.id:' . $id;
        }
        $qp = new QueryParams();
        $qp->query = join(' OR ', $parts);
        return $this->getList($qp);
    }

    /**
     * Set a callback to be notified when ident-request has changed and a ident result is available.
     * Pass null to remove a previous setting.
     * @param callable|null $fn Any function which accepts a BaseCollection class argument.
     * The collection contains the IdentResult instances.
     *
     */
    public function onIdentRequestsChanged($fn)
    {
        $this->registerEventHandler('idreschanged', $fn === null ? null : new IdentResChanged($fn, $this));
    }
}
