<?php

namespace SecucardConnect\Product\Services;

use SecucardConnect\Client\ClientError;
use SecucardConnect\Event\DefaultEventHandler;
use SecucardConnect\Product\General\Model\Event;

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
        if (empty($event->data) || !is_countable($event->data) || count($event->data) == 0) {
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
