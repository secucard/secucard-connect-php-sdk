<?php

namespace SecucardConnect\Auth;

/**
 * Client credentials grant type
 */
class ClientCredentials implements GrantTypeInterface
{
    /**
     * @var string
     */
    public $client_id;
    
    /**
     * @var string
     */
    public $client_secret;

    /**
     * Constructor
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct($clientId, $clientSecret)
    {
        $this->client_id = $clientId;
        $this->client_secret = $clientSecret;
    }

    /**
     * @return string
     */
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
