<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/13 0013
 * Time: 15:12
 */
namespace Wx\Account\User;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class TagUpdate extends WxBaseAccount
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 标签ID
     * @var int
     */
    private $id = 0;
    /**
     * 标签名
     * @var string
     */
    private $name = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/tags/update?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @param int $id
     * @throws \SyException\Wx\WxException
     */
    public function setId(int $id)
    {
        if ($id > 0) {
            $this->reqData['id'] = $id;
        } else {
            throw new WxException('标签ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $name
     * @throws \SyException\Wx\WxException
     */
    public function setName(string $name)
    {
        $nameLength = strlen($name);
        if (($nameLength > 0) && ($nameLength <= 30)) {
            $this->reqData['name'] = $name;
        } else {
            throw new WxException('标签名不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['id'])) {
            throw new WxException('标签ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['name'])) {
            throw new WxException('标签名不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAccount::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode([
            'tag' => $this->reqData,
        ], JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
