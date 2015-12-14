<?php

namespace SecucardConnect\Util;


use JsonMapper;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class MapperUtil
{
    /**
     * @param array | object $json The JSON to map, either an assoc. array or object (stdClass), never a string.
     * @param string $class The class to map to.
     * @param LoggerInterface|null $logger
     * @return object The mapped instance.
     * @throws \JsonMapper_Exception
     */
    public static function map($json, $class, LoggerInterface $logger = null)
    {
        $mapper = new JsonMapper();
        if (!is_object($json)) {
            // must set when json is assoc array
            $mapper->bEnforceMapType = false;
        }
        if (!empty($logger)) {
            $mapper->setLogger($logger);
        }
        $inst = $mapper->map($json, new $class());
        return $inst;
    }

    public static function mapResponse(ResponseInterface $response, $class, LoggerInterface $logger = null)
    {
        return self::map(self::jsonDecode((string)$response->getBody()), $class, $logger);
    }

    public static function jsonDecode($json, $assoc = false, $depth = 512, $options = 0)
    {
        static $jsonErrors = [
            JSON_ERROR_DEPTH => 'JSON_ERROR_DEPTH - Maximum stack depth exceeded',
            JSON_ERROR_STATE_MISMATCH => 'JSON_ERROR_STATE_MISMATCH - Underflow or the modes mismatch',
            JSON_ERROR_CTRL_CHAR => 'JSON_ERROR_CTRL_CHAR - Unexpected control character found',
            JSON_ERROR_SYNTAX => 'JSON_ERROR_SYNTAX - Syntax error, malformed JSON',
            JSON_ERROR_UTF8 => 'JSON_ERROR_UTF8 - Malformed UTF-8 characters, possibly incorrectly encoded'
        ];
        $data = \json_decode($json, $assoc, $depth, $options);
        if (JSON_ERROR_NONE !== json_last_error()) {
            $last = json_last_error();
            throw new \InvalidArgumentException(
                'Unable to parse JSON data: '
                . (isset($jsonErrors[$last])
                    ? $jsonErrors[$last]
                    : 'Unknown error')
            );
        }
        return $data;
    }
}