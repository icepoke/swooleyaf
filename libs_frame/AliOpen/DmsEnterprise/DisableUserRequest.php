<?php

namespace AliOpen\DmsEnterprise;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DisableUser
 *
 * @method string getUid()
 * @method string getTid()
 */
class DisableUserRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('dms-enterprise', '2018-11-01', 'DisableUser');
    }

    /**
     * @param string $uid
     *
     * @return $this
     */
    public function setUid($uid)
    {
        $this->requestParameters['Uid'] = $uid;
        $this->queryParameters['Uid'] = $uid;

        return $this;
    }

    /**
     * @param string $tid
     *
     * @return $this
     */
    public function setTid($tid)
    {
        $this->requestParameters['Tid'] = $tid;
        $this->queryParameters['Tid'] = $tid;

        return $this;
    }
}
