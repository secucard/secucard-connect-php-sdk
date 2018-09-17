<?php

namespace SecucardConnect\Auth;

use SecucardConnect\Client\AuthError;


/**
 * Thrown when an authorization attempt could not performed due invalid credentials.
 * The attempt should be repeated with correct ones.
 *
 * @package SecucardConnect\Auth
 */
class AuthDeniedException extends AuthError
{
}
