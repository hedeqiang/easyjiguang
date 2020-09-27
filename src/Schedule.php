<?php

namespace Hedeqiang\JPush;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hedeqiang\JPush\Traits\HasHttpRequest;

class Schedule extends Base
{
    use HasHttpRequest;

    const ENDPOINT_TEMPLATE = 'https://api.jpush.cn/v3/schedules';

    const ENDPOINT_VERSION = 'v3';


    /**
     * 创建定时任务
     * @param $options
     * @return array
     */
    public function addSchedules($options)
    {
        try {
            return $this->postJson(self::ENDPOINT_TEMPLATE, $options, $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 获取有效的 Schedule 列表
     * @param int $page
     * @param array|int[] $query
     * @return array
     */
    public function getSchedules($page = 1,$query = ['page' => $page])
    {
        try {
            return $this->get(self::ENDPOINT_TEMPLATE, $query, $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }


    /**
     * 获取指定的定时任务
     * @param $schedule_id
     * @return array
     */
    public function getSchedulesById($schedule_id)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,$schedule_id);
        try {
            return $this->get($url, [], $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 获取定时任务对应的所有 msg_id
     * @param $schedule_id
     * @return array
     */
    public function getMsgId($schedule_id)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,$schedule_id .'/msg_ids');
        try {
            return $this->get($url, [], $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 修改指定的 Schedule
     * @param $schedule_id
     * @param $options
     * @return array
     */
    public function updateSchedules($schedule_id,$options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,$schedule_id);
        try {
            return $this->put($url, $options, $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 删除指定的 Schedule 任务
     * @param $schedule_id
     * @return array
     */
    public function deleteSchedules($schedule_id)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,$schedule_id);
        try {
            return $this->delete($url, $options, $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

}