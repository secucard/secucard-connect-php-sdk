<?php

namespace SecucardConnect\Auth;


/**
 * Refresh token grant type
 * Class that is used to refresh token
 */
class RefreshTokenCredentials implements GrantTypeInterface
{

    protected $refresh_token;

    /**
     * Constructor
     * @param $refresh_token
     * @internal param string $refreshToken
     */
    public function __construct($refresh_token)
    {
        $this->refresh_token = $refresh_token;
    }

    /**
     * {@inheritDoc}
     */
    public function getType() {
        return 'refresh_token';
    }

    /**
     * Function add parameters to params array
     * @param array $params
     */
    public function addParameters(&$params)
    {
        $params['refresh_token'] = $this->refresh_token;
    }
}