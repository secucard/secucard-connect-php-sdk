<?php

namespace SecucardConnect;

/**
 * Secucard API Client Configuration
 *
 * @author Rico Simlinger <jr.simlinger@secupay.ag>
 */
class ApiClientConfiguration
{
    const AUTHENTICATION_METHOD_OAUTH = 'oauth';

    const ACCEPT_LANGUAGE_EN = 'en';
    const ACCEPT_LANGUAGE_DE = 'de';

    // The following fields are required when creating the client
    const REQUIRED_FIELDS = [
        'base_url',
        'auth_path',
        'api_path',
    ];

    /**
     * The base url for the SecuConnect server
     *
     * @var string
     */
    private $base_url = 'https://connect.secucard.com';

    /**
     * The path to the SecuConnect authentication system
     *
     * @var string
     */
    private $auth_path = '/oauth/token';

    /**
     * The path to the SecuConnect API
     *
     * @var string
     */
    private $api_path = '/api/v2';

    /**
     * Debugging mode
     *
     * @var bool
     */
    private $debug = false;

    /**
     * The authentication method
     *
     * @var string
     */
    private $auth = self::AUTHENTICATION_METHOD_OAUTH;

    /**
     * Define the api client (it's like the user agent string for browsers)
     * Definition: "{name}/{version}", separator " "
     * Example: "WooCommerce/2.6.11 Wordpress/4.7.1"
     *
     * @See https://tools.ietf.org/html/rfc2616#section-14.43
     *
     * @var string
     */
    private $api_client = '';

    /**
     * Define the language of the error and other api messages
     *
     * @var string
     */
    private $accept_language = 'en';

    /**
     * Create a new instace with the given (array) config attributes
     *
     * @deprecated Only for backward compatibility
     *
     * @param array $config
     *
     * @return self
     */
    public static function createFromArray(array $config)
    {
        $self = new self();

        if (!empty($config['base_url'])) {
            $self->setBaseUrl($config['base_url']);
        }

        if (!empty($config['auth_path'])) {
            $self->setAuthPath($config['auth_path']);
        }

        if (!empty($config['api_path'])) {
            $self->setApiPath($config['api_path']);
        }

        if (!empty($config['debug'])) {
            $self->setDebug($config['debug']);
        }

        if (!empty($config['auth'])) {
            $self->setAuth($config['auth']);
        }

        return $self;
    }

    /**
     * Validates the configuration for the api client
     *
     * @throws \InvalidArgumentException If some required param is missing
     *
     * @return true
     */
    public function isValid()
    {
        $data = $this->toArray();

        $missing = array_diff(self::REQUIRED_FIELDS, array_keys($data));

        if ($missing) {
            throw new \InvalidArgumentException('Config is missing the following keys: ' . implode(', ', $missing));
        }

        return true;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'base_url' => $this->base_url,
            'auth_path' => $this->api_path,
            'api_path' => $this->api_path,
            'debug' => $this->debug,
            'auth' => $this->auth,
            'api_client' => $this->api_client,
        ];
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->base_url;
    }

    /**
     * Define the base url for the SecuConnect server
     *
     * @param string $base_url
     *
     * @throws \InvalidArgumentException If some required param is missing
     *
     * @return self
     */
    public function setBaseUrl($base_url)
    {
        if (empty($base_url)) {
            throw new \InvalidArgumentException('Parameter "base_url" must be filled');
        }
        $this->base_url = $base_url;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthPath()
    {
        return $this->auth_path;
    }

    /**
     * Define the path to the SecuConnect authentication system
     *
     * @param string $auth_path
     *
     * @throws \InvalidArgumentException If some required param is missing
     *
     * @return self
     */
    public function setAuthPath($auth_path)
    {
        if (empty($auth_path)) {
            throw new \InvalidArgumentException('Parameter "auth_path" must be filled');
        }
        $this->auth_path = $auth_path;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiPath()
    {
        return $this->api_path;
    }

    /**
     * Define the path to the SecuConnect API
     *
     * @param string $api_path
     *
     * @throws \InvalidArgumentException If some required param is missing
     *
     * @return self
     */
    public function setApiPath($api_path)
    {
        if (empty($api_path)) {
            throw new \InvalidArgumentException('Parameter "api_path" must be filled');
        }
        $this->api_path = $api_path;
        return $this;
    }

    /**
     * @return bool
     */
    public function getDebug()
    {
        return $this->debug;
    }

    /**
     * Set to TRUE to display the http client logs
     *
     * @param bool $debug
     *
     * @return self
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * Define the authentication method
     *
     * @param string $auth
     *
     * @throws \InvalidArgumentException If some required param is missing or invalid
     *
     * @return self
     */
    public function setAuth($auth)
    {
        $auth = strtolower($auth);

        if (!in_array($auth, [self::AUTHENTICATION_METHOD_OAUTH])) {
            throw new \InvalidArgumentException('Parameter "auth" must be filled and valid');
        }

        $this->auth = $auth;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiClient()
    {
        return $this->api_client;
    }

    /**
     * Define the api client (it's like the user agent string for browsers)
     * Definition: "{name}/{version}", separator " "
     * Example: "WooCommerce/2.6.11 Wordpress/4.7.1 PHP-SDK/1.3.0"
     *
     * @See https://tools.ietf.org/html/rfc2616#section-14.43
     *
     * @param string $api_client
     *
     * @return self
     */
    public function setApiClient($api_client)
    {
        $this->api_client = $api_client;
        return $this;
    }

    /**
     * @return string
     */
    public function getAcceptLanguage()
    {
        return $this->accept_language;
    }

    /**
     * Define the language of the error and other api messages
     *
     * @param string $accept_language
     *
     * @throws \InvalidArgumentException If the given param is invalid
     *
     * @return self
     */
    public function setAcceptLanguage($accept_language)
    {
        $accept_language = strtolower($accept_language);

        if (!in_array($accept_language, [self::ACCEPT_LANGUAGE_EN, self::ACCEPT_LANGUAGE_DE])) {
            throw new \InvalidArgumentException('Parameter "accept_language" must be valid');
        }

        $this->accept_language = $accept_language;
        return $this;
    }

}