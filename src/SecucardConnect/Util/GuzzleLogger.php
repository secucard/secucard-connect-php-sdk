<?php
/**
 * GuzzleSubscriber class
 */

namespace SecucardConnect\Util;

use Closure;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * GuzzleSubscriber to add subscriber to guzzle events to be able to log the requests and responses to API
 *
 */
class GuzzleLogger
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    protected $formatter;

    /**
     * Constructor
     * @param LoggerInterface|Logger $logger Logger used to log messages
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->formatter = new MessageFormatter();
    }


    /**
     * Logs a request and/or a response.
     *
     * @param RequestInterface $request
     * @param ResponseInterface|null $response
     * @param mixed $reason
     * @return null
     */
    protected function log(
        RequestInterface $request,
        ResponseInterface $response = null,
        $reason = null
    ) {
        if ($reason instanceof RequestException) {
            $response = $reason->getResponse();
        }

        $message = $this->formatter->format($request, $response, $reason);
        $context = compact('request', 'response', 'reason');

        return $this->logger->debug($message, $context);
    }


    /**
     * Called when the middleware is handled by the client.
     *
     * @param callable $handler
     *
     * @return Closure
     */
    public function __invoke(callable $handler)
    {
        return function ($request, array $options) use ($handler) {

            $this->log($request);

            return $handler($request, $options)->then(
                $this->onSuccess($request),
                $this->onFailure($request)
            );
        };
    }

    /**
     * Returns a function which is handled when a request was successful.
     *
     * @param RequestInterface $request
     *
     * @return Closure
     */
    protected function onSuccess(RequestInterface $request)
    {
        return function ($response) use ($request) {
            $this->log($request, $response);
            return $response;
        };
    }

    /**
     * Returns a function which is handled when a request was rejected.
     *
     * @param RequestInterface $request
     *
     * @return Closure
     */
    protected function onFailure(RequestInterface $request)
    {
        return function ($reason) use ($request) {

            // Only log a rejected requests if it hasn't already been logged
            $this->log($request, null, $reason);

            return Promise\rejection_for($reason);
        };
    }

}