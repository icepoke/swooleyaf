<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getCsbId()
 * @method $this withCsbId($value)
 */
class GetInstance extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /** @var string */
    public $method = 'GET';
}
