<?php

namespace SecucardConnect\Client;

use Exception;


/**
 * Indicates a general internal error happened. Usually this kind or error is caused by unexpected, unusual conditions
 * and is  most likely not recoverable.
 * @package SecucardConnect\Client
 */
class ClientError extends \Exception
{
    public function __construct($message = "", Exception $previous = null)
    {
        parent::__construct($message . '(' . $previous->getMessage() . ')', 0, $previous);
    }

}