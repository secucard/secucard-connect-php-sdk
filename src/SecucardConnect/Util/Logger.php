<?php
/**
 * Logger class
 */

namespace SecucardConnect\Util;

use Exception;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Psr\Log\LogLevel;

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
     * @param bool $enabled
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
     * @return null|void
     */
    public function log($level, $message, array $context = []): void
    {
        if (!$this->enabled) {
            return;
        }
        $message = self::replace($message, $context);
        if (is_resource($this->resource)) {
            fwrite($this->resource, "[{$level}] " . $message. "\n");
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

    /**
     * @param LoggerInterface $logger
     * @param string $message
     * @param Exception|null $exception
     */
    public static function logWarn(LoggerInterface $logger, $message, \Exception $exception = null)
    {
        self::doLog(LogLevel::WARNING, $logger, $message, $exception);
    }

    /**
     * @param LoggerInterface $logger
     * @param string $message
     * @param Exception|null $exception
     */
    public static function logError(LoggerInterface $logger, $message, \Exception $exception = null)
    {
        self::doLog(LogLevel::ERROR, $logger, $message, $exception);
    }

    /**
     * @param LoggerInterface $logger
     * @param string $message
     * @param Exception|null $exception
     */
    public static function logInfo(LoggerInterface $logger, $message, \Exception $exception = null)
    {
        self::doLog(LogLevel::INFO, $logger, $message, $exception);
    }

    /**
     * @param LoggerInterface $logger
     * @param string $message
     * @param Exception|null $exception
     */
    public static function logDebug(LoggerInterface $logger, $message, \Exception $exception = null)
    {
        self::doLog(LogLevel::DEBUG, $logger, $message, $exception);
    }

    /**
     * @param string $level
     * @param LoggerInterface $logger
     * @param string $message
     * @param \Exception $exception
     */
    private static function doLog($level, LoggerInterface $logger, $message, \Exception $exception = null)
    {
        if (!empty($logger)) {
            $context = [];
            if (!empty($exception)) {
                $context['exception'] = $exception;
            }
            $logger->log($level, $message, $context);
        }
    }

    /**
     * @param string $message
     * @param array $context
     * @return mixed|string
     */
    private static function replace($message, $context)
    {
        foreach ($context as $key => $val) {
            $placeholder = '{' . $key . '}';
            if ($key === 'exception' && is_a($val, Exception::class)) {
                if (strpos($message, $placeholder) == false) {
                    $message .= "\n" . strval($val);
                } else {
                    $message = str_replace($placeholder, "\n" . strval($val), $message);
                }
                continue;
            }

            if (strpos($message, $placeholder) != false) {
                $message = str_replace($placeholder, print_r($val, true), $message);
            }
        }

        return $message;
    }
}
