<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/6/19 0019
 * Time: 12:33
 */
namespace SyException\Map;

use SyException\BaseException;

class BaiduMapException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '百度地图异常';
    }
}
