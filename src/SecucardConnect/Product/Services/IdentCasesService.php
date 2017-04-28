<?php

namespace SecucardConnect\Product\Services;

use SecucardConnect\Client\ProductService;
use SecucardConnect\Client\RequestOptions;
use SecucardConnect\Product\Common\Model\BaseCollection;
use SecucardConnect\Product\Services\Model\IdentCase;


/**
 * Operations for the services/identcases resource.
 * @package SecucardConnect\Product\Services
 */
class IdentCasesService extends ProductService
{
	/**
	 * @param IdentCase $request
	 */
	private function process(IdentCase &$request)
	{
//...
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
