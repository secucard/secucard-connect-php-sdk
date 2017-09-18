<?php

namespace SecucardConnect\Client;

/**
 * Defines all supported  options for API requests.
 * @package SecucardConnect\Client
 */
final class RequestOptions
{
    /**
     * Allows request result post processing by calling a callback with results of a request.
     * The results should be passed by reference.
     */
    const RESULT_PROCESSING = 'resultprocessing';
}