<?php

namespace SecucardConnect\Auth;

use SecucardConnect\Client\AuthError;
use SecucardConnect\Product\Common\Model\Error;


/**
 * Thrown when an authorization attempt could not performed due invalid credentials.
 * The attempt should be repeated with correct ones.
 *
 * @package SecucardConnect\Auth
 */
class AuthDeniedException extends AuthError
{
    /**
     * AuthDeniedException constructor.
     * @param Error $error
     * @param null $message
     */
    public function __construct(Error $error = null, $message = null)
    {
        parent::__construct($error, $message);
    }
}

?>


