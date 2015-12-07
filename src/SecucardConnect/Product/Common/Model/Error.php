<?php

namespace SecucardConnect\Product\Common\Model;

/**
 * Holds detail info about an error.
 * @package SecucardConnect\Product\Common\Model
 */
class Error
{
    /** The error code string. Should give a rough hint about what was going wrong.
     * @var string
     */
    public $error;

    /**
     * May contain more details about this error or the cause.
     * @var string
     */
    public $description;

    /**
     * Error constructor.
     * @param string $error
     * @param  string $description
     */
    public function __construct($error, $description)
    {
        $this->error = $error;
        $this->description = $description;
    }

    function __toString()
    {
        return $this->error . ', ' . $this->description;
    }


}