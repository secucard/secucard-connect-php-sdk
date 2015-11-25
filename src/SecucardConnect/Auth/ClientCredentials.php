<?php

namespace SecucardConnect\Auth;

/**
 * Client credentials grant type
 */
class ClientCredentials implements GrantTypeInterface
{
    protected $client_id;
    protected $client_secret;

    /**
     * Constructor
     * @param $client_id
     * @param $client_secret
     * @internal param array $config
     */
    public function __construct($client_id, $client_secret)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }

    public function getType()
    {
        return 'client_credentials';
    }

    /**
     * Function add parameters to params array
     * @param array $params
     */
    public function addParameters(&$params)
    {
        $params['client_id'] = $this->client_id;
        $params['client_secret'] = $this->client_secret;
    }
}