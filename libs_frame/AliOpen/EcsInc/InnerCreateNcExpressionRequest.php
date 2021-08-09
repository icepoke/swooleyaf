<?php
namespace AliOpen\EcsInc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of InnerCreateNcExpression
 * @method string getGrayBid()
 * @method string getGrayAliUid()
 * @method array getEcsInstanceIds()
 * @method string getExpression()
 * @method array getVSwitchIds()
 */
class InnerCreateNcExpressionRequest extends RpcAcsRequest
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
        parent::__construct('EcsInc', '2016-03-14', 'InnerCreateNcExpression', 'ecs');
    }

    /**
     * @param string $grayBid
     * @return $this
     */
    public function setGrayBid($grayBid)
    {
        $this->requestParameters['GrayBid'] = $grayBid;
        $this->queryParameters['GrayBid'] = $grayBid;

        return $this;
    }

    /**
     * @param string $grayAliUid
     * @return $this
     */
    public function setGrayAliUid($grayAliUid)
    {
        $this->requestParameters['GrayAliUid'] = $grayAliUid;
        $this->queryParameters['GrayAliUid'] = $grayAliUid;

        return $this;
    }

    /**
     * @param array $ecsInstanceIds
     * @return $this
     */
    public function setEcsInstanceIds(array $ecsInstanceIds)
    {
        $this->requestParameters['EcsInstanceIds'] = $ecsInstanceIds;
        foreach ($ecsInstanceIds as $i => $iValue) {
            $this->queryParameters['EcsInstanceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $expression
     * @return $this
     */
    public function setExpression($expression)
    {
        $this->requestParameters['Expression'] = $expression;
        $this->queryParameters['Expression'] = $expression;

        return $this;
    }

    /**
     * @param array $vSwitchIds
     * @return $this
     */
    public function setVSwitchIds(array $vSwitchIds)
    {
        $this->requestParameters['VSwitchIds'] = $vSwitchIds;
        foreach ($vSwitchIds as $i => $iValue) {
            $this->queryParameters['VSwitchId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
