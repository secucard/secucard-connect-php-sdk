<?php

namespace SecucardConnect\Event;

use Exception;
use SecucardConnect\Client\AbstractError;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Product\General\Model\Event;
use SecucardConnect\Util\MapperUtil;

/**
 * Class EventDispatcher
 * @package SecucardConnect\Event
 */
class EventDispatcher
{
    /**
     * @var EventHandler[]
     */
    private $handlerMap = [];

    /**
     * Register/Unregister an event handler for a id.
     * @param $id string An unique id for the handler.
     * @param $handler EventHandler The handler. Pass null to remove from register.
     */
    public function registerEventHandler($id, $handler)
    {
        if ($handler === null) {
            unset($this->handlerMap[$id]);
        } else {
            $this->handlerMap[$id] = $handler;
        }
    }

    /**
     * Dispatch the event string to a responsible handler if any.
     * @param $eventStr string The event JSON.
     * @return void
     * @throws AbstractError
     */
    public function dispatch($eventStr)
    {
        try {
            // decode as array because data proprty, which has unknown structure (only known by handler),
            // must remain array after mapping to event
            $arr = MapperUtil::jsonDecode($eventStr, true); 
            $event = MapperUtil::map($arr, Event::class);
        } catch (Exception $e) {
            throw  new ClientError("Invalid event JSON", $e);
        }

        foreach ($this->handlerMap as $callback) {
            try {
                if ($callback->handle($event)) {
                    return;
                }
            } catch (Exception $e) {
                if (!$e instanceof AbstractError) {
                    throw  new ClientError("Unknown error processing the event", $e);
                } else {
                    throw $e;
                }
            }
        }
    }
}
