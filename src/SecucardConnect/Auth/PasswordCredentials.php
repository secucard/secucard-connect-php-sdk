<?php

namespace SecucardConnect\Auth;

/**
 * Password credentials grant type
 */
class PasswordCredentials implements GrantTypeInterface
{
    protected $username;
    protected $password;

    /**
     * Constructor
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getType()
    {
        return 'password';
    }

    /**
     * Function add parameters to params array
     * @param array $params
     */
    public function addParameters(&$params)
    {
        $params['grant_type'] = $this->getType();
        $params['username'] = $this->username;
        $params['password'] = $this->password;
    }
}