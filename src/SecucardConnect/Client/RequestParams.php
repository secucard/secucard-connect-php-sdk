<?php

namespace SecucardConnect\Client;

/**
 * Class RequestParams
 * @package SecucardConnect\Client
 */
final class RequestParams
{
    /**
     * The operation to perform. See {@link RequestOps} for valid values.
     * @var int
     */
    public $operation;

    /**
     * @var ResourceMetadata
     */
    public $resourceMetadata;

    /**
     * @var string
     */
    public $id;

    /**
     * App identifier for custom actions.
     * @var string
     */
    public $appId;

    /**
     * @var SearchParams
     */
    public $searchParams;

    /**
     * @var string
     */
    public $action;

    /**
     * @var string
     */
    public $actionArg;

    /**
     * @var string
     */
    public $actionId;

    /**
     * @var string
     */
    public $jsonData;

    /**
     * @var array
     */
    public $options;

    /**
     * RequestParams constructor.
     * @param string $operation
     * @param ResourceMetadata $resourceMetadata
     * @param string $id
     * @param SearchParams $searchParams
     * @param null $action
     * @param null $actionArg
     * @param null $jsonData
     * @param array $options
     */
    public function __construct(
        $operation,
        ResourceMetadata $resourceMetadata,
        $id = null,
        SearchParams $searchParams = null,
        $action = null,
        $actionArg = null,
        $jsonData = null,
        array $options = []
    ) {
        $this->operation = $operation;
        $this->resourceMetadata = $resourceMetadata;
        $this->id = $id;
        $this->searchParams = $searchParams;
        $this->action = $action;
        $this->actionArg = $actionArg;
        $this->jsonData = $jsonData;
        $this->options = $options;
    }
}