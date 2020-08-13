<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/27 0027
 * Time: 19:01
 */
namespace LiveEducation;

use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;
use SyTrait\SimpleConfigTrait;

/**
 * Class ConfigBJY
 *
 * @package LiveEducation
 */
class ConfigBJY
{
    use SimpleConfigTrait;

    /**
     * 账号ID
     *
     * @var string
     */
    private $partnerId = '';
    /**
     * 账号密钥
     *
     * @var string
     */
    private $secretKey = '';
    /**
     * 个性域名
     *
     * @var string
     */
    private $privateDomain = '';
    /**
     * api域名
     *
     * @var string
     */
    private $apiDomain = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getPartnerId() : string
    {
        return $this->partnerId;
    }

    /**
     * @param string $partnerId
     *
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setPartnerId(string $partnerId)
    {
        if (ctype_alnum($partnerId)) {
            $this->partnerId = $partnerId;
        } else {
            throw new BJYException('账号ID不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSecretKey() : string
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     *
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setSecretKey(string $secretKey)
    {
        if (ctype_alnum($secretKey)) {
            $this->secretKey = $secretKey;
        } else {
            throw new BJYException('账号密钥不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getPrivateDomain() : string
    {
        return $this->privateDomain;
    }

    /**
     * @return string
     */
    public function getApiDomain() : string
    {
        return $this->apiDomain;
    }

    /**
     * @param string $privateDomain
     *
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setPrivateDomain(string $privateDomain)
    {
        $trueDomain = trim($privateDomain);
        if (strlen($trueDomain) > 0) {
            $this->privateDomain = $trueDomain;
            $this->apiDomain = 'https://' . $trueDomain . '.at.baijiayun.com';
        } else {
            throw new BJYException('个性域名不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }
}
