<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 17:37
 */
namespace SyPay\Union\Channels\NoJump;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseNoJump;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\FileTypeTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\SettleDateTrait;
use SyPay\UtilUnionChannels;

/**
 * 文件传输接口
 *
 * @package SyPay\Union\Channels\NoJump
 */
class FileTransfer extends BaseNoJump
{
    use AccessTypeTrait;
    use SettleDateTrait;
    use FileTypeTrait;
    use CertIdTrait;
    use ReqReservedTrait;

    public function __construct(string $merId, string $envType)
    {
        $this->reqDomains = [
            self::ENV_TYPE_PRODUCT => 'https://filedownload.95516.com',
            self::ENV_TYPE_DEV => 'https://filedownload.test.95516.com',
        ];
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/';
        $this->reqData['bizType'] = '000000';
        $this->reqData['txnType'] = '76';
        $this->reqData['txnSubType'] = '01';
        $this->reqData['accessType'] = 0;
    }

    public function __clone()
    {
    }

    /**
     * @return array
     * @throws \SyException\Pay\UnionException
     */
    public function getDetail() : array
    {
        if (!isset($this->reqData['settleDate'])) {
            throw new UnionException('清算日期不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['fileType'])) {
            throw new UnionException('文件类型不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        UtilUnionChannels::createSign($this->reqData['merId'], $this->reqData);

        return $this->getChannelsContent();
    }
}
