<?php

namespace SecucardConnect\Event;


use SecucardConnect\Product\General\Model\Event;

abstract class AbstractEventHandler implements EventHandler
{
    /**
     * A user callback to invoke.
     * @var callable
     */
    protected $callback;

    /**
     * @var string
     */
    protected $eventTarget;

    /**
     * @var string
     */
    protected $eventType;

    /**
     * @param string $eventTarget
     * @param string $eventType
     * @param callable $callback
     */
    public function __construct($eventTarget = null, $eventType = null, callable $callback = null)
    {
        $this->callback = $callback;
        $this->eventTarget = $eventTarget;
        $this->eventType = $eventType;
    }


    /**
     * Can be used by handlers to determine if a handler should process the given event.
     * The default decision is made by comparing the given and this instances event target and event type.
     * May be overridden to adapt.
     * @param Event $event The event to process.
     * @return bool True if can handle, false else.
     */
    protected function accept($event)
    {
        return $event->target === $this->eventTarget && $event->type === $this->eventType;
    }

    /**
     * Handles a given event.
     * @param $event Event The event to handle.
     * @return bool True if the event was handled, false else. In the latter case another available handler may be
     * invoked with the given event.
     */
    abstract function handle($event);
}
