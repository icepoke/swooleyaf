<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/19 0019
 * Time: 8:33
 */
namespace SyServer;

use Constant\ErrorCode;
use Constant\Server;
use Exception\Validator\ValidatorException;
use Log\Log;
use Request\RequestSign;
use Response\Result;
use Tool\SyPack;
use Tool\Tool;
use Traits\PreProcessRpcFrameTrait;
use Traits\PreProcessRpcProjectTrait;
use Traits\RpcServerTrait;
use Traits\Server\BasicRpcTrait;
use Yaf\Registry;
use Yaf\Request\Http;

class RpcServer extends BaseServer {
    use BasicRpcTrait;
    use RpcServerTrait;
    use PreProcessRpcFrameTrait;
    use PreProcessRpcProjectTrait;

    /**
     * @var \Tool\SyPack
     */
    private $_receivePack = null;

    public function __construct(int $port) {
        parent::__construct($port);
        $projectLength = strlen(SY_PROJECT);
        $serverType = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.modules.' . substr(SY_MODULE, $projectLength) . '.type');
        if($serverType != Server::SERVER_TYPE_API_MODULE){
            exit('服务端类型不支持' . PHP_EOL);
        }
        define('SY_SERVER_TYPE', $serverType);
        $this->_configs['server']['cachenum']['hc'] = (int)Tool::getArrayVal($this->_configs, 'server.cachenum.hc', 0, true);
        $this->_configs['server']['cachenum']['modules'] = (int)Tool::getArrayVal($this->_configs, 'server.cachenum.modules', 0, true);
        $this->_configs['server']['cachenum']['local'] = (int)Tool::getArrayVal($this->_configs, 'server.cachenum.local', 0, true);
        $this->_configs['server']['cachenum']['wx'] = (int)Tool::getArrayVal($this->_configs, 'server.cachenum.wx', 0, true);
        $this->_configs['server']['cachenum']['users'] = (int)Tool::getArrayVal($this->_configs, 'server.cachenum.users', 0, true);
        $this->checkServerRpc();
        $this->_configs['swoole']['open_length_check'] = true;
        $this->_configs['swoole']['package_max_length'] = Server::SERVER_PACKAGE_MAX_LENGTH;
        $this->_configs['swoole']['package_length_type'] = 'L';
        $this->_configs['swoole']['package_length_offset'] = 4;
        $this->_configs['swoole']['package_body_offset'] = 0;
        $this->_receivePack = new SyPack();
    }

    private function __clone() {
    }

    /**
     * 初始化请求数据
     * @param array $data
     */
    private function initRequest(array $data) {
        $_GET = [];
        $_POST = $data;
        $_COOKIE = [];
        $_FILES = [];
        $_SESSION = [];
        unset($_POST[RequestSign::KEY_SIGN]);

        Registry::del(Server::REGISTRY_NAME_SERVICE_ERROR);
    }

    /**
     * 清理
     */
    private function clearRequest() {
        $_GET = [];
        $_POST = [];
        $_COOKIE = [];
        $_FILES = [];
        $_SESSION = [];

        Registry::del(Server::REGISTRY_NAME_SERVICE_ERROR);
    }

    public function start() {
        $this->initTableRpc();
        //初始化swoole服务
        $this->_server = new \swoole_server($this->_host, $this->_port);
        $this->_server->set($this->_configs['swoole']);
        //注册方法
        $this->_server->on('start', [$this, 'onStart']);
        $this->_server->on('managerStart', [$this, 'onManagerStart']);
        $this->_server->on('workerStart', [$this, 'onWorkerStart']);
        $this->_server->on('workerStop', [$this, 'onWorkerStop']);
        $this->_server->on('workerError', [$this, 'onWorkerError']);
        $this->_server->on('shutdown', [$this, 'onShutdown']);
        $this->_server->on('receive', [$this, 'onReceive']);
        $this->_server->on('task', [$this, 'onTask']);
        $this->_server->on('finish', [$this, 'onFinish']);
        $this->_server->on('close', [$this, 'onClose']);

        echo "\e[1;36m start " . SY_MODULE . ":\e[0m \e[1;32m \t[success] \e[0m" . PHP_EOL;

        //启动服务
        $this->_server->start();
    }

    private function initReceive(\swoole_server $server) {
        $this->createReqId();
        self::$_syServer->incr(self::$_serverToken, 'request_times', 1);
        $_SERVER[Server::SERVER_DATA_KEY_TIMESTAMP] = time();
    }

    private function handleApiReceive(array $data) {
        $uriCheckRes = $this->checkRequestUri($data['api_uri']);
        if(strlen($uriCheckRes['error']) > 0){
            $error = new Result();
            $error->setCodeMsg(ErrorCode::COMMON_ROUTE_URI_FORMAT_ERROR, $uriCheckRes['error']);
            $result = $error->getJson();
            unset($error);
            return $result;
        }
        $data['api_uri'] = $uriCheckRes['uri'];

        self::$_reqStartTime = microtime(true);
        $healthTag = $this->sendReqHealthCheckTask($data['api_uri']);
        $this->initRequest($data['api_params']);

        $error = null;
        $result = '';
        $httpObj = null;
        try {
            self::checkRequestCurrentLimit();
            if (isset($this->preProcessMapFrame[$data['api_uri']])) {
                $funcName = $this->preProcessMapFrame[$data['api_uri']];
            } else if(isset($this->preProcessMapProject[$data['api_uri']])){
                $funcName = $this->preProcessMapProject[$data['api_uri']];
            } else {
                $funcName = '';
            }
            if(strlen($funcName) > 0){
                $result = $this->$funcName($data);
            } else {
                $httpObj = new Http($data['api_uri']);
                $result = $this->_app->bootstrap()->getDispatcher()->dispatch($httpObj)->getBody();
            }
            if(strlen($result) == 0){
                $error = new Result();
                $error->setCodeMsg(ErrorCode::SWOOLE_SERVER_NO_RESPONSE_ERROR, '未设置响应数据');
            }
        } catch (\Exception $e) {
            if (!($e instanceof ValidatorException)) {
                Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
            }

            $error = new Result();
            if (is_numeric($e->getCode())) {
                $error->setCodeMsg((int)$e->getCode(), $e->getMessage());
            } else {
                $error->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '服务出错');
            }
        } finally {
            self::$_syServer->decr(self::$_serverToken, 'request_handling', 1);
            $this->clearRequest();
            $this->reportLongTimeReq($data['api_uri'], $data['api_params']);
            self::$_syHealths->del($healthTag);
            unset($httpObj);
            if(is_object($error)){
                $result = $error->getJson();
                unset($error);
            }
        }

        return $result;
    }

    private function handleTaskReceive(\swoole_server $server,string $data) {
        $server->task($data, random_int(1, $this->_taskMaxId));
        $result = new Result();
        $result->setData([
            'msg' => 'task received',
        ]);

        return $result->getJson();
    }

    private function handleReceive(\swoole_server $server,string $data) {
        if(!$this->_receivePack->unpackData($data)){
            $error = new Result();
            $error->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '请求数据格式错误');
            $result = $error->getJson();
            unset($error);
            return $result;
        }

        $command = $this->_receivePack->getCommand();
        $commandData = $this->_receivePack->getData();
        switch ($command) {
            case SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_API_REQ:
                $result = $this->handleApiReceive($commandData);
                break;
            case SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ:
                $result = $this->handleTaskReceive($server, $data);
                break;
            default:
                $error = new Result();
                $error->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '请求命令不支持');
                $result = $error->getJson();
                unset($error);
        }
        Registry::del(Server::REGISTRY_NAME_SERVICE_ERROR);

        return $result;
    }

    public function onWorkerStart(\swoole_server $server, $workerId){
        $this->basicWorkStart($server, $workerId);

        if($workerId == 0){
            $this->addTaskBase($server);
            $this->addTaskRpcTrait($server);
        }
    }

    public function onWorkerStop(\swoole_server $server, int $workerId){
        $this->basicWorkStop($server, $workerId);
    }

    public function onWorkerError(\swoole_server $server, $workId, $workPid, $exitCode){
        $this->basicWorkError($server, $workId, $workPid, $exitCode);
    }

    public function onTask(\swoole_server $server, int $taskId, int $fromId, string $data){
        $baseRes = $this->handleTaskBase($server, $taskId, $fromId, $data);
        if(is_array($baseRes)){
            $taskCommand = Tool::getArrayVal($baseRes['params'], 'task_command', '');
            switch ($taskCommand) {
                default:
                    $traitRes = $this->handleTaskRpcTrait($server, $taskId, $fromId, $baseRes);
                    if(strlen($traitRes) > 0){
                        return $traitRes;
                    }
            }

            $result = new Result();
            $result->setData([
                'result' => 'success',
            ]);
            return $result->getJson();
        } else {
            return $baseRes;
        }
    }

    /**
     * 处理请求
     * @param \swoole_server $server
     * @param int $fd TCP客户端连接的唯一标识符
     * @param int $reactor_id Reactor线程ID
     * @param string $data 收到的数据内容
     */
    public function onReceive(\swoole_server $server,int $fd,int $reactor_id,string $data) {
        $this->initReceive($server);
        $result = $this->handleReceive($server, $data);
        $this->_receivePack->setCommandAndData(SyPack::COMMAND_TYPE_RPC_SERVER_SEND_RSP, [
            'rsp_data' => $result,
        ]);
        $rspData = $this->_receivePack->packData();
        $this->_receivePack->init();

        $sendRes = $server->send($fd, $rspData);
        if(!$sendRes){
            Log::error('rpc send response error, error_code:' . $server->getLastError());
        }
        self::$_reqId = '';
    }
}