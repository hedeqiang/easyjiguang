<?php

namespace Hedeqiang\JPush;

use Hedeqiang\JPush\Exceptions\HttpException;
use Hedeqiang\JPush\Traits\HasHttpRequest;

class Report extends Base
{
    use HasHttpRequest;

    const ENDPOINT_TEMPLATE = 'https://report.jpush.cn/v3';

    const ENDPOINT_VERSION = 'v3';


    /**
     * 送达统计详情（新）
     * @param array $query
     * @return array
     * @throws HttpException
     */
    public function received(array $query)
    {
        /*$query = [
            'msg_id' => $msg_id,
        ];*/
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'received/detail');
        try {
            return $this->get($url, $query, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 送达状态查询
     * @param array $options
     * @return array
     * @throws HttpException
     */
    public function status(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'status/message');
        try {
            return $this->postJson($url, $options, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 消息统计详情（VIP 专属接口，新）
     * @param array $query
     * @return array
     * @throws HttpException
     */
    public function detail(array $query)
    {
        /*$query = [
            'msg_ids' => $msg_ids,
        ];*/
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'messages/detail');
        try {
            return $this->get($url, $query, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 用户统计（VIP 专属接口）
     * @param array $query
     * @return array
     * @throws HttpException
     */
    public function users(array $query)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'users');
        try {
            return $this->get($url, $query, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 分组统计-消息统计（VIP 专属接口）
     * @param array $query
     * @return array
     * @throws HttpException
     */
    public function groupDetail(array $query)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'group/messages/detail');
        try {
            return $this->get($url, $query, $this->getHeader('group'));
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 分组统计-用户统计（VIP 专属接口）
     * @param array $query
     * @return array
     * @throws HttpException
     */
    public function groupUsers(array $query)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'group/users');
        try {
            return $this->get($url, $query, $this->getHeader('group'));
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}