<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 13:52
 */
namespace SyPay\Union\Channels\QrCode;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseQrCode;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\AcqAddnDataTrait;
use SyPay\Union\Channels\Traits\AcqInsCodeTrait;
use SyPay\Union\Channels\Traits\BackUrlTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\ChannelTypeTrait;
use SyPay\Union\Channels\Traits\CtrlRuleTrait;
use SyPay\Union\Channels\Traits\CurrencyCodeTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\Union\Channels\Traits\PayTimeoutTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\ReservedTrait;
use SyPay\Union\Channels\Traits\SubMerInfoTrait;
use SyPay\Union\Channels\Traits\TermIdTrait;
use SyPay\Union\Channels\Traits\TermInfoTrait;
use SyPay\Union\Channels\Traits\TxnAmtTrait;
use SyPay\UtilUnionChannels;

/**
 * 申请预授权二维码接口
 * 商户申请二维码,同步应答二维码信息
 * 供持卡人扫码支付
 * 持卡人每次支付完成,银联通过后台地址发送商户通知
 *
 * @package SyPay\Union\Channels\QrCode
 */
class QrPreAuthApply extends BaseQrCode
{
    use BackUrlTrait;
    use CurrencyCodeTrait;
    use TxnAmtTrait;
    use AccessTypeTrait;
    use ChannelTypeTrait;
    use OrderIdTrait;
    use CertIdTrait;
    use TermInfoTrait;
    use SubMerInfoTrait;
    use AcqInsCodeTrait;
    use ReservedTrait;
    use CtrlRuleTrait;
    use ReqReservedTrait;
    use AcqAddnDataTrait;
    use PayTimeoutTrait;
    use TermIdTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/backTransReq.do';
        $this->reqData['bizType'] = '000000';
        $this->reqData['backUrl'] = 'http://www.specialUrl.com';
        $this->reqData['currencyCode'] = '156';
        $this->reqData['txnType'] = '02';
        $this->reqData['txnSubType'] = '05';
        $this->reqData['accessType'] = 0;
    }

    public function __clone()
    {
    }

    /**
     * @return array
     *
     * @throws \SyException\Pay\UnionException
     */
    public function getDetail() : array
    {
        if (!isset($this->reqData['txnAmt'])) {
            throw new UnionException('交易金额不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['channelType'])) {
            throw new UnionException('渠道类型不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['orderId'])) {
            throw new UnionException('商户订单号不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['certId'])) {
            throw new UnionException('证书ID不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['termInfo'])) {
            throw new UnionException('终端信息不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        UtilUnionChannels::createSign($this->reqData['merId'], $this->reqData);

        return $this->getChannelsContent();
    }
}
