<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 19:18
 */
namespace SyException\ObjectStorage;

use SyException\BaseException;

class KodoException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '七牛云对象存储异常';
    }
}
