<?php

namespace Hedeqiang\JPush;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hedeqiang\JPush\Traits\HasHttpRequest;

class Report
{
    use HasHttpRequest;

    const ENDPOINT_TEMPLATE = 'https://report.jpush.cn/v3';

    const ENDPOINT_VERSION = 'v3';

    protected $config;


    public function __construct(array $config)
    {
        $this->config = new Config($config);
    }

    /**
     * 送达统计详情（新）
     * @param string $msg_id
     * @return array
     */
    public function received(array $query)
    {
//        $query = [
//            'msg_id' => $msg_id,
//        ];
        try {
            return $this->get('/received/detail', $query, $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 送达状态查询
     * @param array $options
     * @return array
     */
    public function status(array $options)
    {
        try {
            return $this->postJson(self::ENDPOINT_TEMPLATE . '/status/message', $options, $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 消息统计详情（VIP 专属接口，新）
     * @param $msg_ids
     * @return array
     */
    public function detail(array $query)
    {
//        $query = [
//            'msg_ids' => $msg_ids,
//        ];
        try {
            return $this->get(self::ENDPOINT_TEMPLATE . '/messages/detail', $query, $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 用户统计（VIP 专属接口）
     * @param array $query
     * @return array
     */
    public function users(array $query)
    {
        try {
            return $this->get(self::ENDPOINT_TEMPLATE . '/users', $query, $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 分组统计-消息统计（VIP 专属接口）
     * @param array $query
     * @return array
     */
    public function groupDetail(array $query)
    {
        try {
            return $this->get(self::ENDPOINT_TEMPLATE . '/group/messages/detail', $query, $this->getHeader('group'));
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 分组统计-用户统计（VIP 专属接口）
     * @param array $query
     * @return array
     */
    public function groupUsers(array $query)
    {
        try {
            return $this->get(self::ENDPOINT_TEMPLATE . '/group/users', $query, $this->getHeader('group'));
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
        else{
            // group
            return base64_encode($this->config->get('groupKey') .':'. $this->config->get('group_secret'));
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