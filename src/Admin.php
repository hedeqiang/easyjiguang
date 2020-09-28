<?php

namespace Hedeqiang\JPush;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hedeqiang\JPush\Traits\HasHttpRequest;

class Admin extends Base
{
    use HasHttpRequest;

    const ENDPOINT_TEMPLATE = 'https://admin.jpush.cn/v1/app';

    const ENDPOINT_VERSION = 'v1';


    /**
     * 创建极光 app
     * @param $options
     * @return array
     */
    public function createApp($options)
    {
        try {
            return $this->postJson(self::ENDPOINT_TEMPLATE,
                $options, $this->getHeader('dev'));
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * app 删除
     * @param string $appKey
     * @return array
     */
    public function deleteApp(string $appKey)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,$appKey .'/delete');
        try {
            return $this->delete(self::ENDPOINT_TEMPLATE . '/' . $url,
                [], $this->getHeader('dev'));
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 证书上传
     * @param string $appKey
     * @param array $options
     * @return array
     */
    public function uploadCertificate(string $appKey,array $options)
    {
      $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,$appKey .'/certificate');
        try {
            return $this->post($url,$options, $this->getHeader('dev'));
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }
}