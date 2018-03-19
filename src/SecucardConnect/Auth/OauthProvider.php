<?php

namespace SecucardConnect\Auth;

use Exception;
use Http\Client\HttpClient;
use Psr\Log\LoggerInterface;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Client\StorageInterface;

/**
 * OauthProvider class that is adding Access tokens to requests
 *
 */
class OauthProvider extends ProductService
{
    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * The GrantTypeInterface to acquire access tokens
     * (in this variable the object of type PasswordCredentials is stored)
     * @var GrantTypeInterface
     */
    protected $credentials;

    /**
     * An array with the "access_token" and "expires_in" keys
     * @var array
     */
    protected $accessToken;

    /**
     * The refresh token string
     * @var string
     */
    protected $refreshToken;

    /**
     * @param HttpClient $httpClient
     */
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }


    /**
     * Constructor
     * @param array $config
     * @param StorageInterface $storage
     * @param GrantTypeInterface $credentials
     */
    public function __construct(
        array $config,
        StorageInterface $storage,
        GrantTypeInterface $credentials
    ) {
        parent::__construct();
        $this->config = $config;
        $this->storage = $storage;
        $this->credentials = $credentials;

        $this->refreshToken = $this->storage->get('refresh_token');
        $this->accessToken = $this->storage->get('access_token');
    }

    /**
     * Get the access token
     *
     * Handles token expiration for tokens with an "expires_in" timestamp
     * In case no valid token was found, tries to acquire a new one
     *
     * @param string $deviceCode
     * @param bool $json Set to true to return the token and the expire time as JSON like
     * {"access_token":"abc", "expires_in":500}
     * @return string
     * @throws ClientError|\Exception
     */
    public function getAccessToken($deviceCode = null, $json = false)
    {
        if (!$this->accessToken) {
            // Try to acquire a new access token from the server
            if ($this->credentials instanceof DeviceCredentials) {
                if (empty($deviceCode)) {
                    return $this->obtainDeviceVerification();
                } else {
                    $res = $this->updateToken(null, $deviceCode);
                    if ($res === false) {
                        return false;
                    }
                }
            } elseif ($this->credentials instanceof RefreshTokenCredentials) {
                $this->updateToken($this->credentials);
            } else {
                $this->updateToken();
            }
        } else {
            if (isset($this->accessToken['expires_in']) && $this->accessToken['expires_in'] < time()) {
                // The access token has expired

                if ($this->credentials instanceof RefreshTokenCredentials) {
                    $this->updateToken($this->credentials);
                } else {
                    if ($this->refreshToken) {
                        if (!$this->credentials instanceof ClientCredentials) {
                            throw new ClientError('Invalid credentials type supplied, must be of type ' . ClientCredentials::class);
                        }
                        $this->updateToken(new RefreshTokenCredentials(
                            $this->credentials->client_id,
                            $this->credentials->client_secret,
                            $this->refreshToken));

                    } else {
                        $this->updateToken();
                    }
                }
            }
        }

        $at = $this->accessToken['access_token'];

        if ($json === true) {
            $arr = [
                'access_token' => $at,
                'expires_in' => $this->accessToken['expires_in'] - time(),
                'expireTime' => $this->accessToken['expires_in']
            ];
            return json_encode($arr);
        } else {
            return $at;
        }

    }

    /**
     * Function to update token based on GrantTypeInterface
     * @param RefreshTokenCredentials|null $refreshToken Refresh token to update existing token or null to obtain new
     * token.
     * @param null|string $deviceCode
     * @return bool False on pending auth, true else.
     * @throws ClientError|\Exception
     */
    private function updateToken(RefreshTokenCredentials $refreshToken = null, $deviceCode = null)
    {
        $tokenData = null;

        // array of url parameters that will be sent in auth request
        $params = [];
        if ($refreshToken == null && !empty($deviceCode)) {
            $tokenData = $this->pollDeviceAccessToken($deviceCode);
            if ($tokenData === false) {
                return false;
            }
        } else {
            $this->setParams($params, $refreshToken == null ? $this->credentials : $refreshToken);

            $tokenData = $this->createRequest($params, null, 'Error obtaining access token.');
        }

        if (empty($tokenData)) {
            throw new ClientError('Error obtaining access token.');
        }

        // Process the returned data, both expired_in and refresh_token are optional parameters
        $this->accessToken = ['access_token' => $tokenData->access_token,];
        if (isset($tokenData->expires_in)) {
            $this->accessToken['expires_in'] = time() + $tokenData->expires_in;
        }

        // Save access token to storage
        $this->storage->set('access_token', $this->accessToken);

        if (isset($tokenData->refresh_token)) {
            $this->refreshToken = $tokenData->refresh_token;
            // Save refresh token to storage
            $this->storage->set('refresh_token', $this->refreshToken);
        }
        // never delete existing refresh token

        return true;
    }

    /**
     * Function to get device verification codes.
     * @return AuthCodes
     * @throws Exception
     */
    private function obtainDeviceVerification()
    {
        if (!$this->credentials instanceof DeviceCredentials) {
            throw new ClientError('Invalid credentials set up, must be of type ' . DeviceCredentials::class);
        }

        $params = [];
        $this->setParams($params, $this->credentials);

        return $this->createRequest($params, new AuthCodes(), 'Error requesting device codes.');
    }

    /**
     * Function to get access token data for device authorization.
     * This method may be invoked multiple times until it returns the token data.
     * @param string $deviceCode The device code obtained by obtainDeviceVerification().
     * @throws \Exception If a error happens.
     * @return mixed | boolean Returns false if the authorization is still pending on server side and the access
     * token data on success.
     */
    private function pollDeviceAccessToken($deviceCode)
    {
        if (!$this->credentials instanceof DeviceCredentials) {
            throw new ClientError('Invalid credentials set up, must be of type ' . DeviceCredentials::class);
        }

        $this->credentials->deviceCode = $deviceCode;

        $params = [];
        $this->setParams($params, $this->credentials);

        try {
            return $this->createRequest($params, null, 'Error during device authentication.');
        } catch (Exception $e) {
            // check for auth pending case
            if ($e instanceof AuthDeniedException && $e->getError() != null
                && $e->getError()->error === 'authorization_pending') {
                return false;
            }
            throw $e;
        } finally {
            // must reset to be ready for new auth attempt
            $this->credentials->deviceCode = null;
        }
    }

    /**
     * @param array $params
     * @param GrantTypeInterface $obj
     * @internal param RefreshTokenCredentials $refreshToken
     */
    private function setParams(&$params, GrantTypeInterface $obj)
    {
        $params['grant_type'] = $obj->getType();
        $obj->addParameters($params);
    }

    /**
     * @param array $params
     * @param object|null $mappingClass
     * @param string $defaultErrorMsg
     * @return mixed
     * @throws Exception|\SecucardConnect\Client\AbstractError
     */
    private function createRequest($params, $mappingClass = null, $defaultErrorMsg) {
        $url = $this->config['base_url'] . $this->config['auth_path'];

        return $this->makeRealRequest(
            $this->httpClient,
            'POST',
            $url,
            ['Content-Type' => 'application/x-www-form-urlencoded'],
            http_build_query($params),
            $mappingClass,
            $defaultErrorMsg
        );
    }
}
