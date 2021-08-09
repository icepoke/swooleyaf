<?php

namespace AliOpen\AliDNS;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeDnsProductInstances
 *
 * @method string getPageNumber()
 * @method string getUserClientIp()
 * @method string getPageSize()
 * @method string getLang()
 * @method string getVersionCode()
 */
class DescribeDnsProductInstancesRequest extends RpcAcsRequest
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
            'DescribeDnsProductInstances',
            'alidns'
        );
    }

    /**
     * @param string $pageNumber
     *
     * @return $this
     */
    public function setPageNumber($pageNumber)
    {
        $this->requestParameters['PageNumber'] = $pageNumber;
        $this->queryParameters['PageNumber'] = $pageNumber;

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
     * @param string $pageSize
     *
     * @return $this
     */
    public function setPageSize($pageSize)
    {
        $this->requestParameters['PageSize'] = $pageSize;
        $this->queryParameters['PageSize'] = $pageSize;

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

    /**
     * @param string $versionCode
     *
     * @return $this
     */
    public function setVersionCode($versionCode)
    {
        $this->requestParameters['VersionCode'] = $versionCode;
        $this->queryParameters['VersionCode'] = $versionCode;

        return $this;
    }
}
