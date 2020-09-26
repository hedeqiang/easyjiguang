<?php

namespace Hedeqiang\JPush;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hedeqiang\JPush\Traits\HasHttpRequest;

class Schedule
{
    use HasHttpRequest;

    const ENDPOINT_TEMPLATE = 'https://api.jpush.cn/v3/schedules';

    const ENDPOINT_VERSION = 'v3';

    protected $config;


    public function __construct(array $config)
    {
        $this->config = new Config($config);
    }

    /**
     * 创建定时任务
     * @param $options
     * @return array
     */
    public function addSchedules($options)
    {
        try {
            $response = $this->postJson(self::ENDPOINT_TEMPLATE, $options, $this->getHeader());
            return $response;
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
            $response = $this->get(self::ENDPOINT_TEMPLATE, $query, $this->getHeader());
            return $response;
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
        try {
            $response = $this->get(self::ENDPOINT_TEMPLATE .'/' . $schedule_id, [], $this->getHeader());
            return $response;
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
        try {
            $response = $this->get(self::ENDPOINT_TEMPLATE .'/' . $schedule_id .'/msg_ids', [], $this->getHeader());
            return $response;
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
        try {
            $response = $this->put(self::ENDPOINT_TEMPLATE .'/' . $schedule_id, $options, $this->getHeader());
            return $response;
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
        try {
            $response = $this->delete(self::ENDPOINT_TEMPLATE .'/' . $schedule_id, $options, $this->getHeader());
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