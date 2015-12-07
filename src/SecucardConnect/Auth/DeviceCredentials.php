<?php

namespace SecucardConnect\Auth;


class DeviceCredentials extends ClientCredentials
{
    /**
     * @var string
     */
    public $deviceId;

    /**
     * @var string
     */
    public $deviceCode;

    public function __construct($clientId, $clientSecret, $deviceId)
    {
        parent::__construct($clientId, $clientSecret);
        $this->deviceId = $deviceId;
    }

    public function getType()
    {
        return 'device';
    }

    public function addParameters(&$params)
    {
        parent::addParameters($params);

        // uuid only used in the first step when a code needs to be obtained,
        if (empty($this->deviceCode)) {
            $params['uuid'] = $this->deviceId;
        } else {
            $params['code'] = $this->deviceCode;
        }
    }


}