<?php

namespace SecucardConnect\Client;

use Exception;
use SecucardConnect\Product\Common\Model\Error;

/**
 * Indicates that an authentication problem happened during a operation.
 * The $error property may contain details.
 * @package SecucardConnect\Client
 */
class AuthError extends AbstractError
{
    /**
     * {@inheritDoc}
     * @param Error|null $error . Additional error details.
     */
    public function __construct(Error $error = null, $message = "", $code = 0, Exception $previous = null)
    {
        if ($message == null) {
            $message = ($error == null ? '' : $error);
        } else {
            if ($error != null) {
                $message .= ' (' . $error . ')';
            }
        }
        parent::__construct($message, $code, $previous);
        $this->error = $error;
    }

    /**
     * @var Error
     */
    protected $error;

    /**
     * @return Error
     */
    public function getError()
    {
        return $this->error;
    }


}
