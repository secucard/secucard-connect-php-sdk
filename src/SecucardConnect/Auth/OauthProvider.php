<?php
/**
 * Class OauthProvider
 */

namespace SecucardConnect\Auth;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;
use SecucardConnect\Client\ClientContext;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Client\StorageInterface;
use SecucardConnect\Util\MapperUtil;

/**
 * OauthProvider class that is adding Access tokens to requests
 *
 * @author Jakub Elias <j.elias@secupay.ag>
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
     * Path string to send there auth_requests
     * @var string
     */
    protected $auth_path;

    /**
     * @param Client $httpClient
     */
    public function setHttpClient($httpClient)
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
     * @param string $auth_path
     * @param StorageInterface $storage
     * @param GrantTypeInterface $credentials
     */
    public function __construct( $auth_path, StorageInterface $storage,
        GrantTypeInterface $credentials
    ) {
        parent::__construct();
        $this->auth_path = $auth_path;
        $this->storage = $storage;
        $this->credentials = $credentials;

        $this->refreshToken = $this->storage->get('refresh_token');
        $this->accessToken = $this->storage->get('access_token');
    }


    /**
     * Adds the authorization header if an access token was found
     * @param RequestInterface $request
     * @param array $options
     * @return \Psr\Http\Message\MessageInterface|RequestInterface If the access token could not properly set to the request.
     * @throws ClientError
     */
    public function appyAuthorization(RequestInterface $request, array $options = null)
    {
        // Only sign requests using "auth"="oauth"
        // IMPORTANT: you have to create special auth client (GuzzleHttp\Client) if you want to get all the request authorized
        if (!isset($options['auth']) || $options['auth'] != 'oauth') {
            return $request;
        }

        // get Access token for current request
        $accessToken = $this->getAccessToken();
        if (is_string($accessToken)) {
            return $request->withHeader('Authorization', 'Bearer ' . $accessToken);
        } else {
            throw new ClientError('Authentication error, invalid on no access token data returned.');
        }
    }

    /**
     * Get the access token
     *
     * Handles token expiration for tokens with an "expires_in" timestamp
     * In case no valid token was found, tries to acquire a new one
     *
     * @param string $deviceCode
     * @return string
     * @throws ClientError
     */
    public function getAccessToken($deviceCode = null)
    {
        if (isset($this->accessToken['expires_in']) && $this->accessToken['expires_in'] < time() && $this->refreshToken) {
            // The access token has expired
            if (!$this->credentials instanceof ClientCredentials) {
                throw new ClientError('Invalid credentials type supplied, must be of type ' . ClientCredentials::class);
            }

            if ($this->credentials instanceof RefreshTokenCredentials) {
                $this->updateToken($this->credentials);
            } else {
                $this->updateToken(new RefreshTokenCredentials($this->credentials->client_id,
                    $this->credentials->client_secret, $this->refreshToken));
            }
        }

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
        }

        return $this->accessToken['access_token'];
    }

    /**
     * Function to update token based on GrantTypeInterface
     * @param RefreshTokenCredentials|null $refreshToken Refresh token to update existing token or null to obtain new
     * token.
     * @param null|string $deviceCode
     * @return bool False on pending auth, true else.
     * @throws ClientError
     */
    private function updateToken(RefreshTokenCredentials $refreshToken = null, $deviceCode = null)
    {
        $tokenData = null;

        // array of url parameters that will be sent in auth request
        $params = array();
        if ($refreshToken == null && !empty($deviceCode)) {
            $tokenData = $this->pollDeviceAccessToken($deviceCode);
            if ($tokenData === false) {
                return false;
            }
        } else {
            $this->setParams($params, $refreshToken == null ? $this->credentials : $refreshToken);

            try {
                $response = $this->post($params);
                $tokenData = MapperUtil::mapResponse($response);
            } catch (Exception $e) {
                throw($this->mapError($e, 'Error obtaining access token.'));
            }
        }

        if (empty($tokenData)) {
            throw new ClientError('Error obtaining access token.');
        }

        // Process the returned data, both expired_in and refresh_token are optional parameters
        $this->accessToken = array('access_token' => $tokenData->access_token,);
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
     * @throws AuthDeniedException
     * @throws BadAuthException
     */
    private function obtainDeviceVerification()
    {
        if (!$this->credentials instanceof DeviceCredentials) {
            throw new ClientError('Invalid credentials set up, must be of type ' . DeviceCredentials::class);
        }

        $params = array();
        $this->setParams($params, $this->credentials);

        // if the guzzle gets response http_status other than 200, it will throw an exception even when there is response available
        try {
            $response = $this->post($params);
            $codes = MapperUtil::mapResponse($response, new AuthCodes(), $this->logger);
            return $codes;
        } catch (ClientException $e) {
            throw $this->mapError($e, 'Error requesting device codes.');
        }
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

        $params = array();
        $this->setParams($params, $this->credentials);

        try {
            $response = $this->post($params);
            return MapperUtil::mapResponse($response);
        } catch (Exception $e) {
            // check for auth pending case
            $err = $this->mapError($e, 'Error during device authentication.');
            if ($err instanceof AuthDeniedException && $err->getError() != null && $err->getError()->error ===
                'authorization_pending'
            ) {
                return false;
            }
            throw $err;
        } finally {
            // must reset to be ready for new auth attempt
            $this->credentials->deviceCode = null;
        }
    }

    /**
     * @param $params
     * @param GrantTypeInterface $obj
     * @internal param RefreshTokenCredentials $refreshToken
     */
    private function setParams(&$params, GrantTypeInterface $obj)
    {
        $params['grant_type'] = $obj->getType();
        $obj->addParameters($params);
    }

    /**
     * @param $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function post($params)
    {
        return $this->httpClient->post($this->auth_path, array('form_params' => $params));
    }
}