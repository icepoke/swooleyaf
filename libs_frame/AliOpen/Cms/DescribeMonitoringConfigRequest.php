<?php
namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of DescribeMonitoringConfig
 *
 */
class DescribeMonitoringConfigRequest extends RpcAcsRequest
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
        parent::__construct(
            'Cms',
            '2019-01-01',
            'DescribeMonitoringConfig',
            'cms'
        );
    }
}
