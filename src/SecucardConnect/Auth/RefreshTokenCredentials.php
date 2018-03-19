<?php

namespace SecucardConnect\Auth;


/**
 * Refresh token grant type
 * Class that is used to refresh token
 */
class RefreshTokenCredentials extends ClientCredentials
{
    protected $refresh_token;

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $refresh_token
     */
    public function __construct($clientId, $clientSecret, $refresh_token)
    {
        if (empty($clientId)) {
            throw new \InvalidArgumentException("Parameter [clientId] can not be empty!");
        }

        if (empty($clientSecret)) {
            throw new \InvalidArgumentException("Parameter [clientSecret] can not be empty!");
        }

        parent::__construct($clientId, $clientSecret);
        $this->refresh_token = $refresh_token;
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {
        return 'refresh_token';
    }

    /**
     * Function add parameters to params array
     * @param array $params
     */
    public function addParameters(&$params)
    {
        parent::addParameters($params);
        $params['refresh_token'] = $this->refresh_token;
    }
}