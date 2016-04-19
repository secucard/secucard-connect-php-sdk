<?php

namespace SecucardConnect\Product\Services;

use SecucardConnect\Client\ProductService;
use SecucardConnect\Client\RequestOptions;
use SecucardConnect\Product\Common\Model\BaseCollection;
use SecucardConnect\Product\Services\Model\IdentRequest;


/**
 * Operations for the services/identrequests resource.
 * @package SecucardConnect\Product\Services
 */
class IdentRequestsService extends ProductService
{
    /**
     * Handles proper contact picture initialization after retrieval of a ident request.
     * @param IdentRequest $request
     */
    private function process(IdentRequest &$request)
    {
        if (isset($request->person)) {
            foreach ($request->person as $p) {
                $contact = $p->contact;
                if (!empty($contact) && !empty($contact->picture)) {
                    $contact->pictureObject = $this->initMediaResource($contact->picture);
                }
            }
        }
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
                } elseif ($value instanceof IdentRequest) {
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
}
