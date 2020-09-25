<?php

namespace Hedeqiang\JPush;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class JPush
{
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
     * 向某单个设备或者某设备列表推送一条通知、或者消息。
     * @param array $options
     * @return string
     */
    public function message(array $options)
    {
        try {
            $client = $this->getHttpClient()->post(self::ENDPOINT_TEMPLATE, [
                'headers' => [
                    'Authorization' => 'Basic ' . $this->getAuthStr()
                ],
                'json' => $options
            ]);
            return $client->getBody()->getContents();
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
    public function getCid(int $count = 1,string $type = 'push')
    {
        try {
            $client = $this->getHttpClient()->get(self::ENDPOINT_TEMPLATE .'/push/cid', [
                'headers' => [
                    'Authorization' => 'Basic ' . $this->getAuthStr()
                ],
                'query' => [
                    'count' => $count,
                    'type'  => $type,
                ]
            ]);
            return $client->getBody()->getContents();
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 推送校验 API
     * @param $options
     * @return string
     */
    public function validate($options)
    {
        try {
            $client = $this->getHttpClient()->post(self::ENDPOINT_TEMPLATE . '/push/validate', [
                'headers' => [
                    'Authorization' => 'Basic ' . $this->getAuthStr()
                ],
                'json' => $options
            ]);
            return $client->getBody()->getContents();
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
            $client = $this->getHttpClient()->post(self::ENDPOINT_TEMPLATE . '/push/batch/regid/single', [
                'headers' => [
                    'Authorization' => 'Basic ' . $this->getAuthStr()
                ],
                'json' => $options
            ]);
            return $client->getBody()->getContents();
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
            $client = $this->getHttpClient()->post(self::ENDPOINT_TEMPLATE . '/push/batch/alias/single', [
                'headers' => [
                    'Authorization' => 'Basic ' . $this->getAuthStr()
                ],
                'json' => $options
            ]);
            return $client->getBody()->getContents();
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 推送撤销
     * @param $msgid
     * @return string
     */
    public function delete($msgid)
    {
        try {
            $client = $this->getHttpClient()->delete(self::ENDPOINT_TEMPLATE .'/push/' . $msgid , [
                'headers' => [
                    'Authorization' => 'Basic ' . $this->getAuthStr()
                ],
            ]);
            return $client->getBody()->getContents();
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
            $client = $this->getHttpClient()->delete(self::ENDPOINT_TEMPLATE .'/push/file' , [
                'headers' => [
                    'Authorization' => 'Basic ' . $this->getAuthStr()
                ],
                'json' => $options
            ]);
            return $client->getBody()->getContents();
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
            $client = $this->getHttpClient()->delete(self::ENDPOINT_TEMPLATE .'/grouppush' , [
                'headers' => [
                    'Authorization' => 'Basic ' . $this->getAuthStr()
                ],
                'json' => $options
            ]);
            return $client->getBody()->getContents();
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    public function groupPushFile(array $options)
    {
        try {
            $client = $this->getHttpClient()->delete(self::ENDPOINT_TEMPLATE .'/grouppush/file' , [
                'headers' => [
                    'Authorization' => 'Basic ' . $this->getAuthStr()
                ],
                'json' => $options
            ]);
            return $client->getBody()->getContents();
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }


    protected function getHttpClient(): Client
    {
        return new Client($this->guzzleOptions);
    }

    /**
     * @param array $options
     * @return array
     */
    protected function setGuzzleOptions(array $options): array
    {
        $this->guzzleOptions = $options;
    }
}