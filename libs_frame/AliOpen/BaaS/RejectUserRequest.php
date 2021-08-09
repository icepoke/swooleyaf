<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

namespace AliOpen\BaaS;

use AliOpen\Core\RpcAcsRequest;

class RejectUserRequest extends RpcAcsRequest
{
    private $reason;

    private $bizid;

    private $bid;

    private $userName;

    public function __construct()
    {
        parent::__construct('Baas', '2018-07-31', 'RejectUser');
        $this->setMethod('POST');
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    public function getBizid()
    {
        return $this->bizid;
    }

    public function setBizid($bizid)
    {
        $this->bizid = $bizid;
    }

    public function getBid()
    {
        return $this->bid;
    }

    public function setBid($bid)
    {
        $this->bid = $bid;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
}
