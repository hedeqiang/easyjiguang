<?php

namespace Hedeqiang\JPush;

use Hedeqiang\JPush\Traits\HasHttpRequest;

abstract class Base
{
    use HasHttpRequest;

    protected $config;

    public function __construct(array $config)
    {
        $this->config = new Config($config);
    }

    /**
     * 获取 Header
     * @param string $type
     * @return string[]
     */
    protected function getHeader($type = 'app'): array
    {
        return [
            'Authorization' => 'Basic ' . $this->getAuthStr($type)
        ];
    }

    /**
     * @param string $type
     * @return string
     */
    protected function getAuthStr(string $type): string
    {
        if ($type === 'app')
            return base64_encode($this->config->get('appKey') .':'. $this->config->get('masterSecret'));
        else if($type === 'group'){
            // group
            return base64_encode($this->config->get('groupKey') .':'. $this->config->get('groupSecret'));
        }
        else if($type === 'dev'){
            return base64_encode($this->config->get('devKey') .':'. $this->config->get('devSecret'));
        }
    }

    /**
     * Build endpoint url.
     * @param string $url
     * @param string $action
     * @return string
     */
    protected function buildEndpoint(string $url,string $action)
    {
        return $url . '/' . $action;
    }
}