<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/28 0028
 * Time: 10:29
 */
namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Live\BaiJiaException;
use SyLive\ConfigAliYun;
use SyTool\Tool;
use SyTrait\LiveConfigTrait;
use SyTrait\SingletonTrait;

/**
 * Class LiveConfigSingleton
 * @package DesignPatterns\Singletons
 */
class LiveConfigSingleton
{
    use SingletonTrait;
    use LiveConfigTrait;

    /**
     * 阿里云配置
     * @var \SyLive\ConfigAliYun
     */
    private $aliYunConfig = null;
    /**
     * 百家云配置列表
     * @var array
     */
    private $baiJiaConfigs = [];
    /**
     * 百家云配置清理时间戳
     * @var int
     */
    private $baiJiaClearTime = 0;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\LiveConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 获取阿里云配置
     * @return \SyLive\ConfigAliYun
     * @throws \SyException\Cloud\AliException
     */
    public function getAliYunConfig()
    {
        if (is_null($this->aliYunConfig)) {
            $configs = Tool::getConfig('live.' . SY_ENV . SY_PROJECT . '.aliyun');
            $aliYunConfig = new ConfigAliYun();
            $aliYunConfig->setRegionId((string)Tool::getArrayVal($configs, 'aliyun.region.id', '', true));
            $aliYunConfig->setAccessKey((string)Tool::getArrayVal($configs, 'aliyun.access.key', '', true));
            $aliYunConfig->setAccessSecret((string)Tool::getArrayVal($configs, 'aliyun.access.secret', '', true));
            $this->aliYunConfig = $aliYunConfig;
        }

        return $this->aliYunConfig;
    }

    /**
     * 获取所有的百家云配置
     * @return array
     */
    public function getBaiJiaConfigs()
    {
        return $this->baiJiaConfigs;
    }

    /**
     * 获取本地百家云配置
     * @param string $partnerId
     * @return \SyLive\ConfigBaiJia|null
     */
    private function getLocalBaiJiaConfig(string $partnerId)
    {
        $nowTime = Tool::getNowTime();
        if ($this->baiJiaClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->baiJiaConfigs as $ePartnerId => $bjyConfig) {
                if ($bjyConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $ePartnerId;
                }
            }
            foreach ($delIds as $ePartnerId) {
                unset($this->baiJiaConfigs[$ePartnerId]);
            }

            $this->baiJiaClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_LIVE_BAIJIA_CLEAR;
        }

        return Tool::getArrayVal($this->baiJiaConfigs, $partnerId, null);
    }

    /**
     * 获取百家云配置
     * @param string $partnerId
     * @return \SyLive\ConfigBaiJia|null
     * @throws \SyException\Live\BaiJiaException
     */
    public function getBaiJiaConfig(string $partnerId)
    {
        $nowTime = Tool::getNowTime();
        $baiJiaConfig = $this->getLocalBaiJiaConfig($partnerId);
        if (is_null($baiJiaConfig)) {
            $baiJiaConfig = $this->refreshBaiJiaConfig($partnerId);
        } elseif ($baiJiaConfig->getExpireTime() < $nowTime) {
            $baiJiaConfig = $this->refreshBaiJiaConfig($partnerId);
        }

        if ($baiJiaConfig->isValid()) {
            return $baiJiaConfig;
        } else {
            throw new BaiJiaException('百家云配置不存在', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * 移除百家云配置
     * @param string $partnerId
     */
    public function removeBaiJiaConfig(string $partnerId)
    {
        unset($this->baiJiaConfigs[$partnerId]);
    }
}