<?php

namespace SecucardConnect\Client;

/**
 * Class SearchParams
 * @package SecucardConnect\Client
 */
final class SearchParams
{
    /**
     * @var QueryParams
     */
    public $query;

    /**
     * @var string
     */
    public $scrollExpire;

    /**
     * @var string
     */
    public $scrollId;

    /**
     * SearchParams constructor.
     * @param QueryParams $query
     * @param string $scrollExpire
     * @param string $scrollId
     */
    public function __construct(QueryParams $query = null, $scrollExpire = null, $scrollId = null)
    {
        $this->query = $query;
        $this->scrollExpire = $scrollExpire;
        $this->scrollId = $scrollId;
    }
}