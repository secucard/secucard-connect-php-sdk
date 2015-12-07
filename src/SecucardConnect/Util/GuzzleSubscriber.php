<?php
/**
 * GuzzleSubscriber class
 */
namespace SecucardConnect\Util;

use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Event\ErrorEvent;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;
use Psr\Log\LoggerInterface;

/**
 * GuzzleSubscriber to add subscriber to guzzle events to be able to log the requests and responses to API
 *
 */
class GuzzleSubscriber implements SubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Constructor
     * @param LoggerInterface|Logger $logger Logger used to log messages
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Function for GuzzleHttp
     * @return array
     */
    public function getEvents()
    {
        return [
            // Fire after responses are verified (which trigger error events).
            'complete' => ['onComplete', RequestEvents::VERIFY_RESPONSE - 10],
            'error' => ['onError', RequestEvents::EARLY]
        ];
    }

    /**
     * onComplete Event handler function
     * @param CompleteEvent $event
     */
    public function onComplete(CompleteEvent $event)
    {
        $request = $event->getRequest();
        $response = $event->getResponse();

        if (substr($event->getResponse()->getStatusCode(), 0, 1) == '2') {
            $this->logger->info(">>>>>>>>\n{$request}\n<<<<<<<<\n{$response}\n--------\n");
        } else {
            $this->logger->warning(">>>>>>>>\n{$request}\n<<<<<<<<\n{$response}\n--------\n");
        }
    }

    /**
     * onError event handler function
     * @param ErrorEvent $event
     */
    public function onError(ErrorEvent $event)
    {
        $request = $event->getRequest();
        $response = $event->getResponse();
        $error = $event->getException();
        $this->logger->error(">>>>>>>>\n{$request}\n<<<<<<<<\n{$response}\n--------\n{$error}");
    }
}