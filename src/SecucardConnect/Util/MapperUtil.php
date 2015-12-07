<?php

namespace SecucardConnect\Util;


use JsonMapper;
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
}