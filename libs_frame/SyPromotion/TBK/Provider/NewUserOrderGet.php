<?php
/**
 * 查询新用户订单明细
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Provider;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetPageNo2Trait;
use SyPromotion\TBK\Traits\SetPageSizeTrait;
use SyPromotion\TBK\Traits\SetSiteIdTrait;

/**
 * Class NewUserOrderGet
 *
 * @package SyPromotion\TBK\Provider
 */
class NewUserOrderGet extends BaseTBK
{
    use SetPageNo2Trait;
    use SetPageSizeTrait;
    use SetAdZoneIdTrait;
    use SetSiteIdTrait;

    /**
     * 页数
     *
     * @var int
     */
    private $page_no = 0;
    /**
     * 每页记录数
     *
     * @var int
     */
    private $page_size = 0;
    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 开始时间
     *
     * @var int
     */
    private $start_time = 0;
    /**
     * 结束时间
     *
     * @var int
     */
    private $end_time = 0;
    /**
     * 活动id
     *
     * @var string
     */
    private $activity_id = '';
    /**
     * 站点ID
     *
     * @var int
     */
    private $site_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.newuser.order.get');
        $this->reqData['page_no'] = 1;
        $this->reqData['page_size'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStartTime(int $startTime)
    {
        if ($startTime > 0) {
            $this->reqData['start_time'] = date('Y-h-d H:i:s', $startTime);
        } else {
            throw new TBKException('开始时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setEndTime(int $endTime)
    {
        if ($endTime > 0) {
            $this->reqData['end_time'] = date('Y-h-d H:i:s', $endTime);
        } else {
            throw new TBKException('结束时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setActivityId(string $activityId)
    {
        if (\strlen($activityId) > 0) {
            $this->reqData['activity_id'] = $activityId;
        } else {
            throw new TBKException('活动id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['activity_id'])) {
            throw new TBKException('活动id不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
