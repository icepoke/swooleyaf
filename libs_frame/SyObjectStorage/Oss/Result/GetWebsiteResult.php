<?php
namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\WebsiteConfig;

/**
 * Class GetWebsiteResult
 * @package SyObjectStorage\Oss\Result
 */
class GetWebsiteResult extends Result
{
    /**
     * Parse WebsiteConfig data
     * @return \SyObjectStorage\Oss\Model\WebsiteConfig
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $config = new WebsiteConfig();
        $config->parseFromXml($content);

        return $config;
    }

    /**
     * Judged according to the return HTTP status code, [200-299] that is OK, get the bucket configuration interface,
     * 404 is also considered a valid response
     * @return bool
     */
    protected function isResponseOk()
    {
        $status = $this->rawResponse->status;
        if ((int)(intval($status) / 100) == 2 || (int)(intval($status)) === 404) {
            return true;
        }

        return false;
    }
}