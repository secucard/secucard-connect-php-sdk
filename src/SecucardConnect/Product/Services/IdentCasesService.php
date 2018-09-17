<?php

namespace SecucardConnect\Product\Services;

use GuzzleHttp\Exception\GuzzleException;
use SecucardConnect\Client\ApiError;
use SecucardConnect\Client\AuthError;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Product\Services\Model\IdentCase;

/**
 * Operations for the services/identcases resource.
 * @package SecucardConnect\Product\Services
 */
class IdentCasesService extends ProductService
{
    /**
     * @param string $identcaseId IdentCase ID
     * @return mixed
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function startIdentCase($identcaseId)
    {
        return $this->execute($identcaseId, 'start', null, null, IdentCase::class);
    }

    /**
     * @param string $identcaseId IdentCase ID
     * @return mixed
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function closeIdentCase($identcaseId)
    {
        return $this->execute($identcaseId, 'close', null, null, IdentCase::class);
    }

    /**
     * @param string $identcaseId IdentCase ID
     * @return mixed
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function resetIdentCase($identcaseId)
    {
        return $this->execute($identcaseId, 'reset', null, null, IdentCase::class);
    }

    /**
     * @param string $identcaseId IdentCase ID
     * @param string $taskId Task ID
     * @return mixed
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function taskIdentCase($identcaseId, $taskId)
    {
        return $this->updateWithAction($identcaseId, 'task', $taskId, null, IdentCase::class);
    }
}
