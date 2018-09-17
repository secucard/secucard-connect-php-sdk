<?php

namespace SecucardConnect\Product\Services;

use GuzzleHttp\Exception\GuzzleException;
use SecucardConnect\Client\ApiError;
use SecucardConnect\Client\AuthError;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Client\QueryParams;
use SecucardConnect\Client\RequestOptions;
use SecucardConnect\Product\Common\Model\BaseCollection;
use SecucardConnect\Product\Services\Model\IdentResult;

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
     * @throws GuzzleException
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

    /**
     * {@inheritDoc}
     */
    protected function getRequestOptions()
    {
        return [
            RequestOptions::RESULT_PROCESSING => function (&$value) {
                if ($value instanceof BaseCollection) {
                    $results = $value->items;
                } elseif ($value instanceof IdentResult) {
                    $results[] = $value;
                } else {
                    return;
                }

                foreach ($results as $result) {
                    $this->process($result);
                }
            }
        ];
    }

    /**
     * Handles proper attachments initialization after retrieval of a ident result.
     * @param IdentResult $result
     */
    private function process(IdentResult &$result)
    {
        if (isset($result->person)) {
            foreach ($result->person as $p) {
                $attachments = $p->attachments;
                if (!empty($attachments)) {
                    foreach ($attachments as $attachment) {
                        $this->initMediaResource($attachment);
                    }
                }
            }
        }
    }
}
