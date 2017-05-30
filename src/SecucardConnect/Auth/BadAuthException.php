<?php


namespace SecucardConnect\Auth;


use SecucardConnect\Client\AuthError;

/**
 * Thrown when a authorization attempt failed due bad request data like missing, invalid, misused data.
 * Most likely caused by wrong API usage or bugs and not recoverable without code changes.
 * @package SecucardConnect\Auth
 */
class BadAuthException extends AuthError
{

}