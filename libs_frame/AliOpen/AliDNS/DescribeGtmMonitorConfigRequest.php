<?php

namespace AliOpen\AliDNS;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeGtmMonitorConfig
 *
 * @method string getMonitorConfigId()
 * @method string getUserClientIp()
 * @method string getLang()
 */
class DescribeGtmMonitorConfigRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'Alidns',
            '2015-01-09',
            'DescribeGtmMonitorConfig',
            'alidns'
        );
    }

    /**
     * @param string $monitorConfigId
     *
     * @return $this
     */
    public function setMonitorConfigId($monitorConfigId)
    {
        $this->requestParameters['MonitorConfigId'] = $monitorConfigId;
        $this->queryParameters['MonitorConfigId'] = $monitorConfigId;

        return $this;
    }

    /**
     * @param string $userClientIp
     *
     * @return $this
     */
    public function setUserClientIp($userClientIp)
    {
        $this->requestParameters['UserClientIp'] = $userClientIp;
        $this->queryParameters['UserClientIp'] = $userClientIp;

        return $this;
    }

    /**
     * @param string $lang
     *
     * @return $this
     */
    public function setLang($lang)
    {
        $this->requestParameters['Lang'] = $lang;
        $this->queryParameters['Lang'] = $lang;

        return $this;
    }
}
