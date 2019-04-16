<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/4/11 0011
 * Time: 18:37
 */
namespace Tool;

use Constant\ErrorCode;
use Constant\Project;
use Constant\Server;
use DesignPatterns\Factories\CacheSimpleFactory;
use Exception\Session\JwtException;
use Request\SyRequest;
use Traits\SimpleTrait;
use Yaf\Registry;

final class SessionTool {
    use SimpleTrait;

    /**
     * 校验会话JWT数据
     * @return array
     */
    public static function checkSessionJwt() : array {
        $resArr = [
            'uid' => '',
            'rid' => '',
            'exp' => 0,
            'error' => '',
        ];

        $jwtData = Registry::get(Server::REGISTRY_NAME_RESPONSE_JWT_DATA);
        $sign = hash('md5', $jwtData['uid'] . $jwtData['exp'] . SY_SESSION_SECRET);
        if($sign == $jwtData['sig']){
            $resArr['uid'] = $jwtData['uid'];
            $resArr['rid'] = $jwtData['rid'];
            $resArr['exp'] = (int)$jwtData['exp'];
        } else {
            $resArr['error'] = '会话签名错误';
        }

        return $resArr;
    }

    /**
     * 设置会话JWT的刷新标识
     * @param string $tag
     * @return bool|string
     */
    public static function setSessionJwtRid(string $tag){
        $redisKey = Project::REDIS_PREFIX_SESSION_JWT_REFRESH . $tag;
        $rid = Tool::createNonceStr(6, 'numlower') . time();
        if(CacheSimpleFactory::getRedisInstance()->set($redisKey, $rid, SY_SESSION_JW_RID_EXPIRE)){
            return $rid;
        } else {
            return false;
        }
    }

    /**
     * 生成会话JWT数据
     * @param array $data
     * 必填字段:
     *   uid: string|int 用户标识
     * @throws \Exception\Session\JwtException
     */
    public static function createSessionJwt(array &$data){
        $uid = Tool::getArrayVal($data, 'uid', null);
        if(is_string($uid) || is_numeric($uid)){
            if(strlen((string)$uid) > 0){
                $rid = (string)Tool::getArrayVal($data, 'rid', '');
                if(strlen($rid) == 0){
                    $redisKey = Project::REDIS_PREFIX_SESSION_JWT_REFRESH . $uid;
                    $redisData = CacheSimpleFactory::getRedisInstance()->get($redisKey);
                    $data['rid'] = is_string($redisData) ? $redisData : '';
                }
            } else {
                $data['rid'] = '';
            }
            $data['exp'] = time() + SY_SESSION_JW_EXPIRE;
            $data['sig'] = hash('md5', $data['uid'] . $data['exp'] . SY_SESSION_SECRET);
        } else {
            throw new JwtException('标识不正确', ErrorCode::SESSION_JWT_DATA_ERROR);
        }
    }

    /**
     * 生成默认JWT数据
     * @return array
     */
    public static function createDefaultJwt() : array {
        $jwtData = [
            'uid' => '',
        ];
        self::createSessionJwt($jwtData);

        return $jwtData;
    }

    /**
     * 初始化会话JWT数据
     */
    public static function initSessionJwt() {
        if (isset($_COOKIE[Project::DATA_KEY_SESSION_TOKEN])) {
            $token = (string)$_COOKIE[Project::DATA_KEY_SESSION_TOKEN];
        } else if(isset($_SERVER['SY-AUTH'])){
            $token = (string)$_SERVER['SY-AUTH'];
        } else {
            $token = (string)SyRequest::getParams('session_id', '');
        }
        if ((strlen($token) == 18) && ctype_alnum($token)) {
            $redisKey = Project::REDIS_PREFIX_SESSION . $token;
            $cacheData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
            if((!isset($cacheData['session_id'])) || ($cacheData['session_id'] != $token)){
                $cacheData = self::createDefaultJwt();
            }
        } else {
            $token = Tool::createNonceStr(8, 'numlower') . Tool::getNowTime();
            $cacheData = self::createDefaultJwt();
        }
        Registry::set(Server::REGISTRY_NAME_RESPONSE_JWT_DATA, $cacheData);
        Registry::set(Server::REGISTRY_NAME_RESPONSE_JWT_SESSION, $token);
    }
}