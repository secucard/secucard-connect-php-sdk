<?php

namespace SecucardConnect\Client;


/**
 * Indicates that the server communication failed because of network problems. The client may repeat the operation
 * later when the network connection is established again.
 * @package SecucardConnect\Client
 */
class NetworkError extends \Exception
{

}