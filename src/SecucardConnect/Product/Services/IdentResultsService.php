<?php

namespace SecucardConnect\Product\Services;

use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Client\QueryParams;
use SecucardConnect\Client\RequestOptions;
use SecucardConnect\Event\DefaultEventHandler;
use SecucardConnect\Product\Common\Model\BaseCollection;
use SecucardConnect\Product\General\Model\Event;
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
     * @param $fn callable|null Any function which accepts a BaseCollection class argument.
     * The collection contains the IdentResult instances.
     *
     */
    public function onIdentRequestsChanged($fn)
    {
        $this->registerEventHandler('idreschanged', $fn === null ? null : new IdentResChanged($fn, $this));
    }
}

/**
 * Internal class to handle a debit change event.
 * @package SecucardConnect\Product\Payment
 */
class IdentResChanged extends DefaultEventHandler
{
    /**
     * @param Event $event
     * @throws ClientError
     * @throws \Exception
     */
    function onEvent($event)
    {
        if (empty($event->data) || count($event->data) == 0) {
            throw new ClientError('Invalid event data, no ident-request id(s) found.');
        }

        $ids = [];
        foreach ($event->data as $item) {
            $ids[] = $item['id'];
        }

        call_user_func($this->callback, $this->service->getListByRequestIds($ids));
    }

    /**
     * Overwrite the accept function, so the event with identrequest can be handled by identresults service
     *
     * @param Event $event
     * @return bool
     */
    protected function accept(Event $event)
    {
        return $event->target === 'services.identrequests' && $event->type === $this->eventType;
    }
}
