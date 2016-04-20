<?php

namespace SecucardConnect\Event;


use SecucardConnect\Client\ProductService;
use SecucardConnect\Product\General\Model\Event;

abstract class DefaultEventHandler implements EventHandler
{
    /**
     * A user callback to invoke.
     * @var callable
     */
    protected $callback;

    /**
     * @var ProductService
     */
    protected $service;

    /**
     * @var string
     */
    public $eventTarget;

    /**
     * @var string
     */
    public $eventType;

    /**
     * @param callable $callback
     * @param ProductService $service
     * @param string $eventType
     */
    public function __construct(callable $callback, $service, $eventType = 'changed')
    {
        $this->callback = $callback;
        $this->eventTarget = $service->getResourceId();
        $this->eventType = $eventType;
        $this->service = $service;
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

    function handle($event)
    {
        if ($this->accept($event)) {
            $this->onEvent($event);
            return true;
        }

        return false;
    }

    /**
     * Implement to handle the event.
     * @param $event
     * @return void
     */
    abstract function onEvent($event);
}
