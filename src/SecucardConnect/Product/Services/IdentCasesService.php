<?php

namespace SecucardConnect\Product\Services;

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
     */
    public function startIdentCase($identcaseId)
    {
        return $this->execute($identcaseId, 'start', null, null, IdentCase::class);
    }

    /**
     * @param string $identcaseId IdentCase ID
     * @return mixed
     */
    public function closeIdentCase($identcaseId)
    {
        return $this->execute($identcaseId, 'close', null, null, IdentCase::class);
    }

    /**
     * @param string $identcaseId IdentCase ID
     * @return mixed
     */
    public function resetIdentCase($identcaseId)
    {
        return $this->execute($identcaseId, 'reset', null, null, IdentCase::class);
    }

    /**
     * @param string $identcaseId IdentCase ID
     * @param string $taskId Task ID
     * @return mixed
     */
    public function taskIdentCase($identcaseId, $taskId)
    {
        return $this->updateWithAction($identcaseId, 'task', $taskId, null, IdentCase::class);
    }
}
