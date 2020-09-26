<?php

namespace Hedeqiang\JPush;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hedeqiang\JPush\Traits\HasHttpRequest;

class Admin
{
    use HasHttpRequest;

    const ENDPOINT_TEMPLATE = 'https://admin.jpush.cn/v1/app';

    const ENDPOINT_VERSION = 'v1';

    protected $config;


    public function __construct(array $config)
    {
        $this->config = new Config($config);
    }

    /**
     * 创建极光 app
     * @param $options
     * @return array
     */
    public function createApp($options)
    {
        try {
            $response = $this->postJson(self::ENDPOINT_TEMPLATE,
                $options, $this->getHeader('dev'));
            return $response;
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
        try {
            $response = $this->delete(self::ENDPOINT_TEMPLATE . '/' . $appKey .'/delete',
                [], $this->getHeader('dev'));
            return $response;
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 证书上传
     * @param string $appKey
     * @param array $multipart
     * @return array
     */
    public function uploadCertificate(string $appKey,array $multipart)
    {
        try {
            $response = $this->post(self::ENDPOINT_TEMPLATE . '/' . $appKey .'/certificate',
                [],$multipart, $this->getHeader('dev'));
            return $response;
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
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
            return base64_encode($this->config->get('groupKey') .':'. $this->config->get('group_secret'));
        }
        else if($type === 'dev'){
            return base64_encode($this->config->get('devKey') .':'. $this->config->get('dev_secret'));
        }
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

}