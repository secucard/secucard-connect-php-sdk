<?php

namespace SecucardConnect\Client;

use Exception;


/**
 * Indicates a general internal error happened. Usually this kind or error is caused by unexpected, unusual conditions
 * and is  most likely not recoverable.
 * @package SecucardConnect\Client
 */
class ClientError extends AbstractError
{
	/**
	 * ClientError constructor.
	 *
	 * @param string $message
	 * @param Exception|null $previous
	 */
    public function __construct($message = "", Exception $previous = null)
    {
        $msg = $message;
        if ($previous != null) {
            $msg .= '(' . $previous->getMessage() . ')';
        }
        parent::__construct($msg, 0, $previous);
    }

}
