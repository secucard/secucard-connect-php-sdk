<?php

namespace SecucardConnect\Event;


use SecucardConnect\Product\General\Model\Event;

/**
 * Interface EventHandler
 * @package SecucardConnect\Event
 */
interface EventHandler
{
    /**
     * Handles a given event.
     * @param Event $event The event to handle.
     * @return bool True if the event was handled, false else. In the latter case another available handler may be
     * invoked with the given event.
     */
    function handle(Event $event);
}
