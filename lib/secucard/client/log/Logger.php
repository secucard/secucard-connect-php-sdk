<?php
/**
 * Logger class
 */

namespace secucard\client\log;

use Psr\Log\LoggerTrait;
use Psr\Log\LoggerInterface;

/**
 * Logger implementation that can write to a function, resource, or uses echo() if nothing is provided
 */
class Logger implements LoggerInterface
{
    use LoggerTrait;

    /**
     * The resource where the log should be written
     * @var mixed
     */
    private $resource;

    /**
     * Flag if the logger is enabled
     * @var boolean
     */
    private $enabled;

    /**
     * Constructor
     * @param mixed $resource
     */
    public function __construct($resource = null, $enabled = false)
    {
        $this->resource = $resource;
        $this->enabled = $enabled;
    }

    /**
     * Log function
     * @param string $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = array())
    {
        if (!$this->enabled) {
            return;
        }
        if (is_resource($this->resource)) {
            fwrite($this->resource, "[{$level}] {$message}\n");
        } elseif (is_callable($this->resource)) {
            call_user_func($this->resource, "[{$level}] {$message}\n");
        } else {
            echo "[{$level}] {$message}\n";
        }
    }

    /**
     * Setter for enabled
     * @param bool $value
     */
    public function setEnabled($value)
    {
        $this->enabled = $value;
    }
}