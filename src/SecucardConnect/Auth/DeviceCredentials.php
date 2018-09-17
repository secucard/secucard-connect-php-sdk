<?php

namespace SecucardConnect\Auth;


/**
 * Class DeviceCredentials
 * @package SecucardConnect\Auth
 */
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

    /**
     * DeviceCredentials constructor.
     * @param string $clientId
     * @param string $clientSecret
     * @param string $vendor
     * @param array $vendorIds
     */
    public function __construct($clientId, $clientSecret, $vendor, $vendorIds)
    {
        parent::__construct($clientId, $clientSecret);
        $this->vendor = $vendor;
        $this->vendorIds = $vendorIds;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'device';
    }

    /**
     * @param array $params
     */
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


    /**
     * @return string
     */
    private function buildUuid()
    {
        $id = '/vendor/' . $this->vendor;

        foreach ($this->vendorIds as $name => $value) {
            $id .= '/' . $name . '/' . $value;
        }

        return $id;
    }


}
