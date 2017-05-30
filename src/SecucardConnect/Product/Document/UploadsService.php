<?php

namespace SecucardConnect\Product\Document;

use SecucardConnect\Client\ProductService;

//use SecucardConnect\Client\RequestOptions;
//use SecucardConnect\Product\Common\Model\BaseCollection;
//use SecucardConnect\Product\Document\Model\Upload;

/**
 * Operations for the services/uploads resource.
 * @package SecucardConnect\Product\Document
 */
class UploadsService extends ProductService
{
//    /**
//     * {@inheritDoc}
//     */
//    protected function getRequestOptions()
//    {
//        return [
//            RequestOptions::RESULT_PROCESSING => function (&$value) {
//                if ($value instanceof BaseCollection) {
//                    $results = $value->items;
//                } elseif ($value instanceof Upload) {
//                    $results[] = $value;
//                } else {
//                    return;
//                }
//
//                foreach ($results as $result) {
//                    $this->process($result);
//                }
//            }
//        ];
//    }
//
//    /**
//     * @param Upload $request
//     */
//    private function process(Upload &$request)
//    {
////...
//    }
}
