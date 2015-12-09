<?php

namespace SecucardConnect\Auth;


class DeviceCredentials extends ClientCredentials
{
    /**
     * ID-Name/Value pairs identifying the device.
     * @var array
     */
    public $vendorIds;

    /**
     * The vendor name.
     * @var string
     */
    public $vendor;

    /**
     * Authorization code, obtained from a auth call.
     * @var string
     */
    public $deviceCode;

    public function __construct($clientId, $clientSecret, $vendor, $vendorIds)
    {
        parent::__construct($clientId, $clientSecret);
        $this->vendor = $vendor;
        $this->vendorIds = $vendorIds;
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
            $params['uuid'] = $this->buildUuid();
        } else {
            $params['code'] = $this->deviceCode;
        }
    }


    private function buildUuid()
    {
        $id = '/vendor/' . $this->vendor;

        foreach ($this->vendorIds as $name => $value) {
            $id .= '/' . $name . '/' . $value;
        }

        return $id;
    }


}