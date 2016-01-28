<?php

namespace SecucardConnect\Client;


use Exception;

/**
 * /**
 * Indicates business related errors happening when a API call could not performed properly.<br/>
 * Happens for example when input data are invalid or if not enough balance exist for a product or the API was
 * not used properly.<br/>
 * Holds detailed information about the cause which should presented to the end user like a error code or a support id.
 * @package SecucardConnect\Client
 */
class ApiError extends \Exception
{
    /**
     * @var string
     */
    private $userMessage;

    /**
     * @var string
     */
    private $details;

    /**
     * @var string
     */
    private $supportId;

    /**
     * @var string
     */
    private $serverError;


    /** Return a user friendly message (maybe translated) describing the problem.
     * @return string
     */
    public function getUserMessage()
    {
        return $this->userMessage;
    }

    /**
     * Returns an unique error id to provide to the support facility.
     * @return string
     */
    public function getSupportId()
    {
        return $this->supportId;
    }

    /**
     * Returns the original error type the server was submitting.
     * May give additional hints about the problem.
     * @return string
     */
    public function getServerError()
    {
        return $this->serverError;
    }


    public function __construct(
        $serverError,
        $code,
        $details,
        $userMessage,
        $supportId,
        Exception $previous = null
    ) {
        $msg = 'API Error: type=' . $serverError
            . ', code=' . $code
            . ', details="' . $details
            . '", user-message="' . $userMessage
            . '", support-id=' . $supportId;
        parent::__construct($msg, $code, $previous);
        $this->serverError = $serverError;
        $this->userMessage = $userMessage;
        $this->supportId = $supportId;
        $this->details = $details;
    }


}