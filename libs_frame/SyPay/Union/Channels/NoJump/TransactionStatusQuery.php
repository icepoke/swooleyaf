<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 17:37
 */
namespace SyPay\Union\Channels\NoJump;

use SyPay\Union\Channels\BaseNoJump;

/**
 * 交易状态查询接口
 * 对于未收到交易结果的联机交易,商户应向银联全渠道支付平台发起交易状态查询交易,查询交易结果
 * 完成交易的过程不需要同持卡人交互,属于后台交易
 *
 * @package SyPay\Union\Channels\NoJump
 */
class TransactionStatusQuery extends BaseNoJump
{
    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
    }

    public function __clone()
    {
    }

    public function getDetail() : array
    {
        // TODO: Implement getDetail() method.
    }
}