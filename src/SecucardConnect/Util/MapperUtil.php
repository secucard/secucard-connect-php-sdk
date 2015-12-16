<?php

namespace SecucardConnect\Util;


use JsonMapper;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class MapperUtil
{
    private static $jsonErrors = [
        JSON_ERROR_DEPTH => 'JSON_ERROR_DEPTH - Maximum stack depth exceeded',
        JSON_ERROR_STATE_MISMATCH => 'JSON_ERROR_STATE_MISMATCH - Underflow or the modes mismatch',
        JSON_ERROR_CTRL_CHAR => 'JSON_ERROR_CTRL_CHAR - Unexpected control character found',
        JSON_ERROR_SYNTAX => 'JSON_ERROR_SYNTAX - Syntax error, malformed JSON',
        JSON_ERROR_UTF8 => 'JSON_ERROR_UTF8 - Malformed UTF-8 characters, possibly incorrectly encoded'
    ];

    /**
     * Mapping JSON string to a instance of a given class.
     * @param array | object $json The JSON to map, either an assoc. array or object (stdClass), never a string.
     * @param string $class The full qualified name of the class to map to.
     * @param LoggerInterface|null $logger
     * @return mixed The created instance, never null-
     * @throws \Exception If the mapping could not completed.
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

    /**
     * Encodes the given instance to a JSON string.
     * @param mixed $object The instance to encode.
     * @return string The encoded string or false on failure.
     */
    public static function jsonEncode($object)
    {
        return json_encode($object);
    }

    /**
     * Maps a response body which contains JSON to an object of a given class or to default PHP types.
     * @param ResponseInterface $response The response
     * @param string $class The full qualified name of the class to map to or null to map to default types.
     * @param LoggerInterface|null $logger
     * @return mixed The created instance, never null.
     * @throws \Exception If the mapping could not completed.
     */
    public static function mapResponse(ResponseInterface $response, $class = null, LoggerInterface $logger = null)
    {
        $dec = self::jsonDecode((string)$response->getBody());
        if ($class != null) {
            return self::map($dec, $class, $logger);
        }
        return $dec;
    }

    /**
     * Decodes an JSON string into a object with properties of standard PHP types, including stdClass or assoc array.
     * @param string $json The string to decode.
     * @param boolean $assoc If true a assoc array is returned.
     * @return mixed The created object, never null or other.
     */
    public static function jsonDecode($json, $assoc = false)
    {
        $data = \json_decode($json, $assoc);
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