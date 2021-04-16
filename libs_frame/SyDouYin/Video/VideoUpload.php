<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Video;

use SyConstant\ErrorCode;
use SyDouYin\BaseVideo;
use SyDouYin\Util;
use SyException\DouYin\DouYinVideoException;

/**
 * 上传视频文件到文件服务器，获取视频文件video_id。该接口适用于抖音
 *
 * @package SyDouYin\Video
 */
class VideoUpload extends BaseVideo
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/video/upload/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $openId 用户openid
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setOpenId(string $openId)
    {
        if (\strlen($openId) > 0) {
            $this->reqData['open_id'] = $openId;
        } else {
            throw new DouYinVideoException('用户openid不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param string $video 上传视频文件
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setVideo(string $video)
    {
        if (!is_file($video)) {
            throw new DouYinVideoException('上传视频文件不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        if (!is_readable($video)) {
            throw new DouYinVideoException('上传视频文件不可读', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }

        $file = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $file->file($video);
        if (!is_string($mimeType)) {
            throw new DouYinVideoException('获取上传视频文件类型失败', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        if (substr($mimeType, 0, 6) != 'video/') {
            throw new DouYinVideoException('上传视频文件类型不支持', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }

        $this->reqData['video'] = new \CURLFile($video);
        $this->reqData['Content-Type'] = $mimeType;
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinVideoException('用户openid不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        if (!isset($this->reqData['video'])) {
            throw new DouYinVideoException('上传视频文件不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        $this->serviceUri .= '?open_id=' . urlencode($this->reqData['open_id']);
        $this->serviceUri .= '&access_token=' . urlencode($this->getAccessToken($this->reqData['open_id'], Util::SERVICE_HOST_TYPE_DOUYIN));
        unset($this->reqData['open_id']);
        $this->getContent();
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Content-Type: multipart/form-data'
        ];
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->reqData;

        return $this->curlConfigs;
    }
}
