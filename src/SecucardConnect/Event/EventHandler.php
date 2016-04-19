<?php
namespace SecucardConnect\Event;


use SecucardConnect\Product\General\Model\Event;

interface EventHandler
{
    /**
     * Handles a given event.
     * @param $event Event The event to handle.
     * @return bool True if the event was handled, false else. In the latter case another available handler may be
     * invoked with the given event.
     */
    function handle($event);
}
