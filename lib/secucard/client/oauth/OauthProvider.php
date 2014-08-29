<?php
/**
 * Class OauhtProvider
 */

namespace secucard\client\oauth;

use secucard\client\oauth\GrantType\GrantTypeInterface;
use secucard\client\oauth\GrantType\ClientCredentials;
use secucard\client\oauth\GrantType\RefreshTokenCredentials;

use GuzzleHttp\Client;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;
use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Event\ErrorEvent;

/**
 * OauthProvider class that is adding Access tokens to requests
 *
 * @author Jakub Elias <j.elias@secupay.ag>
 */
class OauthProvider implements SubscriberInterface
{
    /**
     * Client to get the Auth information
     * You can use special client for authorization requests or reuse the current
     *
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * The client credentials to acquire access tokens
     * @var ClientCredentials
     */
    protected $clientCredentials;

    /**
     * The GrantTypeInterface to acquire access tokens
     * (in this variable the object of type PasswordCredentials is stored)
     * @var GrantTypeInterface
     */
    protected $grantTypeInterface;

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
     * Url with path to send there auth_requests
     * @var unknown_type
     */
    protected $auth_url;

    /**
     * Constructor
     * @param string $auth_url
     * @param GuzzleHttp\Client $client
     * @param ClientCredentials $clientCredentials
     * @param GrantTypeInterface $grantTypeCredentials
     */
    public function __construct($auth_url, Client $client, ClientCredentials $clientCredentials, GrantTypeInterface $grantTypeCredentials)
    {
        $this->auth_url = $auth_url;
        $this->client = $client;
        $this->clientCredentials = $clientCredentials;
        $this->grantTypeCredentials = $grantTypeCredentials;
    }

    /**
     * Function to get subscribed event
     * @return array
     */
    public function getEvents()
    {
        return array(
            'before' => array('onBefore', RequestEvents::SIGN_REQUEST),
            'error' => array('onError', RequestEvents::VERIFY_RESPONSE),
        );
    }

    /**
     * Request before-send event handler
     *
     * Adds the Authorization header if an access token was found
     *
     * @param BeforeEvert $event - Event received
     */
    public function onBefore(BeforeEvent $event)
    {
        $request = $event->getRequest();

        // Only sign requests using "auth"="oauth"
        // IMPORTANT: you have to create special auth client (GuzzleHttp\Client) if you want to get all the request authorized
        if ($request->getConfig()['auth'] != 'oauth') {
            return;
        }

        // get Access token for current request
        $accessToken = $this->getAccessToken();
        if ($accessToken) {
            $request->setHeader('Authorization', 'Bearer ' . $accessToken['access_token']);
        }
    }

    /**
      * Request error event handler
      *
      * Handles unauthorized errors by acquiring a new access token and retrying the request
      *
      * @param Event $event Event received
      */
    public function onError(ErrorEvent $event)
    {
        $response = $event->getResponse();
        if ($response && $response->getStatusCode() == 401) {
            if ($event->getRequest()->getHeader('X-Guzzle-Retry')) {
                // We already retried once, give up
                return;
            }

            // Acquire a new access token, and retry the request
            $newAccessToken = $this->getAccessToken();
            if ($newAccessToken) {
                $newRequest = clone $event->getRequest();
                $newRequest->setHeader('Authorization', 'Bearer ' . $newAccessToken['access_token']);
                $newRequest->setHeader('X-Guzzle-Retry', '1');
                // TODO this line should replace the "error" response with new response
                $event->intercept($newRequest->send());
                $event->stopPropagation();
            }
        }
    }

    /**
     * Get the access token
     *
     * Handles token expiration for tokens with an "expires_in" timestamp
     * In case no valid token was found, tries to acquire a new one
     *
     * @return array
     */
    public function getAccessToken()
    {
        if (isset($this->accessToken['expires_in']) && $this->accessToken['expires_in'] < time()) {
            // The access token has expired
            $this->updateToken(new \secucard\client\oauth\GrantType\RefreshTokenCredentials($this->refreshToken));
        }
        if (!$this->accessToken) {
            // Try to acquire a new access token from the server
            $this->newAccessToken();
        }

        return $this->accessToken;
    }

    /**
     * Function to create newAccessToken based on $this->grantTypeCredentials
     */
    private function newAccessToken()
    {
        $this->updateToken($this->grantTypeCredentials);
    }

    /**
     * Function to update token based on GrantTypeInterface
     * @param GrantTypeInterface $grant_type
     */
    private function updateToken(GrantTypeInterface $grantTypeCredentials)
    {
        // array of url parameters that will be sent in auth request
        $params = array('grant_type'=>$grantTypeCredentials->getType());
        $this->clientCredentials->addParameters($params);
        $grantTypeCredentials->addParameters($params);

        $response = $this->client->post($this->auth_url, array('body'=>$params));
        $tokenData = $response->json();

        // Process the returned data, both expired_in and refresh_token are optional parameters
        $this->accessToken = array('access_token'=>$tokenData['access_token'],);
        if (isset($tokenData['expires_in'])) {
            $this->accessToken['expires_in'] = time() + $tokenData['expires_in'];
        }
        if (isset($tokenData['refresh_token'])) {
            $this->refreshToken = $tokenData['refresh_token'];
        }
    }
}