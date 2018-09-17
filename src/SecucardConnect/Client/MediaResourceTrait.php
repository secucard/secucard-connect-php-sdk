<?php


namespace SecucardConnect\Client;

use Psr\Http\Message\StreamInterface;

/**
 * Trait which adds support for all URL based media resources like images or pdf documents.
 * Supports caching of the resource denoted by the URL of this instance. That means the content is downloaded and
 * put to the cache on demand. Further access is served by the cache.<br/>
 * Note: This is not a caching by LRU strategy or alike. If used the content will be
 * cached for new instances or when the URL of the instance was changed (its eventually the same).
 * @package SecucardConnect\Product\Common\Model
 */
trait MediaResourceTrait
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * @var StorageInterface
     */
    private $store;

    /**
     * The URL of the resource.
     * @var string;
     */
    private $url;

    /**
     * @var boolean
     */
    private $cached = false;

    /**
     * The HTTP client to use to get the content.
     * @param \GuzzleHttp\Client $httpClient
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Set the storage where this instance will be cached to.
     * @param StorageInterface $store
     */
    public function setStore($store)
    {
        $this->store = $store;
    }

    /**
     * Returning the resources URL.
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Setting the resources URL.
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->cached = false;
        $this->url = $url;
    }

    /**
     * Removes this object from cache.
     * @throws ClientError
     */
    public function clear()
    {
        if (empty($this->store)) {
            throw new ClientError('Missing store instance to use for this operation.');
        }

        if (!empty($this->url)) {
            $this->store->delete($this->getKey($this->url));
        }

        $this->cached = false;
    }

    /**
     * Download this resource contents and cache using the storage instance passed when creating the secucard
     * connect API client.
     * @throws ClientError
     */
    public function download()
    {
        $this->downloadMe();
    }

    /**
     * Return the contents of this resource as stream.
     * @param bool $cache True if the content should be cached locally by using the storage instance passed when
     * creating the secucard connect API client.
     * @return StreamInterface
     * @throws ClientError
     */
    public function getContents($cache = true)
    {
        $result = $this->downloadMe($cache);
        if ($cache) {
            $result = $this->store->get($this->getKey($this->url));
        }

        return $result;
    }

    /**
     * @param bool $cache
     *
     * @return null|StreamInterface
     * @throws ClientError
     * @throws \Exception
     */
    private function downloadMe($cache = true)
    {
        if (empty($this->httpClient)) {
            throw new ClientError('Missing HTTP client to use for this operation.');
        }

        if ($cache) {
            if (empty($this->store)) {
                throw new ClientError('Missing store instance to use for this operation.');
            }

            if ($this->cached) {
                return null;
            }

            $this->cached = true;
        }

        try {
            $response = $this->httpClient->get($this->url);
            if ($response->getStatusCode() != 200) {
                throw new \Exception('Unable to download.');
            }
            if (!$cache) {
                return $response->getBody();
            }

            $this->store->set($this->getKey($this->url), $response->getBody());
        } catch (\Exception $e) {
            $this->cached = false;
            throw $e;
        }
        return null;
    }

    /**
     * @param string $key
     * @return mixed
     */
    private function getKey($key)
    {
        return preg_replace("/[^a-z0-9\\.-]/", '', $key);
    }
}
