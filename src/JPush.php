<?php

namespace Hedeqiang\JPush;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hedeqiang\JPush\Traits\HasHttpRequest;

class JPush
{
    use HasHttpRequest;

    const ENDPOINT_TEMPLATE = 'https://api.jpush.cn/v3';

    const ENDPOINT_VERSION = 'v3';

    protected $config;

    protected $guzzleOptions = [];

    public function __construct(array $config)
    {
        $this->config = new Config($config);
    }

    /**
     *
     * @return string
     */
    protected function getAuthStr(): string
    {
        return base64_encode($this->config->get('appKey') .':'. $this->config->get('masterSecret'));
    }

    /**
     * 获取 Header
     * @return \string[][]
     */
    protected function getHeader(): array
    {
        return [
            'Authorization' => 'Basic ' . $this->getAuthStr()
        ];
    }

    /**
     * 向某单个设备或者某设备列表推送一条通知、或者消息。
     * @param array $options
     * @return string
     */
    public function message(array $options)
    {
        try {
            $response = $this->postJson(self::ENDPOINT_TEMPLATE . '/push', $options, $this->getHeader());
            return $response;
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 推送唯一标识符
     * @param int $count
     * @param string $type
     * @return string
     */
    public function getCid($count = 1,$type = 'push')
    {
        $query = [
            'count' => $count,
            'type'  => $type,
        ];
        try {
            $response = $this->get(self::ENDPOINT_TEMPLATE .'/push/cid', $query, $this->getHeader());
            return $response;
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 推送校验 API
     * @param $options
     * @return string
     */
    public function validate(array $options)
    {
        try {
            $response = $this->postJson(self::ENDPOINT_TEMPLATE . '/push/validate', $options, $this->getHeader());
            return $response;
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 批量单推  针对的是RegID方式批量单推
     * @param array $options
     * @return string
     */
    public function batchRegidSingle(array $options)
    {
        try {
            $response = $this->postJson(self::ENDPOINT_TEMPLATE . '/push/batch/regid/single', $options, $this->getHeader());
            return $response;
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 针对的是Alias方式批量单推
     * @param array $options
     * @return string
     */
    public function batchAliasSingle(array $options)
    {
        try {
            $response = $this->postJson(self::ENDPOINT_TEMPLATE . '/push/batch/alias/single', $options, $this->getHeader());
            return $response;
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 推送撤销
     * @param $msgid
     * @return string
     */
    public function revoke($msgid)
    {
        try {
            $response = $this->delete(self::ENDPOINT_TEMPLATE .'/push/' . $msgid , $this->getHeader());
            return $response;
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 文件推送
     * @param array $options
     * @return string
     */
    public function file(array $options)
    {
        try {
            $response = $this->postJson(self::ENDPOINT_TEMPLATE .'/push/file', $options, $this->getHeader());
            return $response;
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * Group Push API：应用分组推送
     * @param array $options
     * @return string
     */
    public function groupPush(array $options)
    {
        try {
            $response = $this->postJson(self::ENDPOINT_TEMPLATE .'/grouppush', $options, $this->getHeader());
            return $response;
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 应用分组文件推送（VIP专属接口）
     * @param array $options
     * @return array
     */
    public function groupPushFile(array $options)
    {
        try {
            $response = $this->postJson(self::ENDPOINT_TEMPLATE .'/grouppush/file', $options, $this->getHeader());
            return $response;
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }
}