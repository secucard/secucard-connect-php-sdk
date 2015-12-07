<?php
/**
 * Created by IntelliJ IDEA.
 * User: tk
 * Date: 03.12.15
 * Time: 23:07
 */

namespace SecucardConnect\Auth;

/**
 * Holds the data returned from a successful authorization request.
 *
 * @package SecucardConnect\Auth
 */
class AuthCodes
{
    /**
     * A code the secucard API user must provide along with his client credentials when polling for the actual access
     * token.
     * @var string
     */
    public $device_code;

    /**
     * The code or PIN the end user should enter at the URL given by $verification_url.
     * @var string
     */
    public $user_code;

    /**
     * The URL the end user should visit and enter the code in $user_code.
     * @var string
     */
    public $verification_url;

    /**
     * The time in seconds this codes are valid, counting from obtaining time.
     * @var int
     */
    public $expires_in;

    /**
     * The interval in seconds the secucard API user should poll for the access token after the authorization tokens
     * are obtained.
     * @var int
     */
    public $interval;
}