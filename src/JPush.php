<?php

namespace Hedeqiang\JPush;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hedeqiang\JPush\Traits\HasHttpRequest;

class JPush extends Base
{
    use HasHttpRequest;

    const ENDPOINT_TEMPLATE = 'https://api.jpush.cn/v3';

    const ENDPOINT_VERSION = 'v3';


    /**
     * 向某单个设备或者某设备列表推送一条通知、或者消息。
     * @param array $options
     * @return string
     */
    public function message(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'push');
        try {
            return $this->postJson($url, $options, $this->getHeader());
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
    public function getCid(array $query)
    {
//        $query = [
//            'count' => $count,
//            'type'  => $type,
//        ];
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'push/cid');
        try {
            return $this->get($url, $query, $this->getHeader());
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
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'push/validate');
        try {
            return $this->postJson($url, $options, $this->getHeader());
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
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'push/batch/regid/single');
        try {
            return $this->postJson($url, $options, $this->getHeader());
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
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'push/batch/alias/single');
        try {
            return $this->postJson($url, $options, $this->getHeader());
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
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'push/' .$msgid);
        try {
            return $this->delete($url, $this->getHeader());
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
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'push/file');
        try {
            return $this->postJson($url, $options, $this->getHeader());
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
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'grouppush');
        try {
            return $this->postJson($url, $options, $this->getHeader('group'));
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
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'grouppush/file');
        try {
            return $this->postJson($url, $options, $this->getHeader('group'));
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }
}