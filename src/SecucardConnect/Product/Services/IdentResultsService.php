<?php

namespace SecucardConnect\Product\Services;

use SecucardConnect\Client\ProductService;
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
                        $attachment->setHttpClient($this->httpClient);
                        $attachment->setStore($this->storage);
                    }
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

}