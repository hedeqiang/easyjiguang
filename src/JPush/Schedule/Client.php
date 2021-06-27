<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JPush\Schedule;

use EasyJiGuang\Kernel\Support\BaseClient;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://api.jpush.cn/v3/schedules';

    const ENDPOINT_VERSION = 'v3';

    /**
     * 创建定时任务
     *
     * @param $options
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addSchedules($options)
    {
        return $this->httpPostJson(self::ENDPOINT_TEMPLATE, $options, $this->getHeader());
    }

    /**
     * 获取有效的 Schedule 列表.
     *
     * @param  int          $page
     * @param  array|int[]  $query
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSchedules(int $page = 1, array $query = ['page' => $page])
    {
        return $this->httpGet(self::ENDPOINT_TEMPLATE, $query, $this->getHeader());
    }

    /**
     * 获取指定的定时任务
     *
     * @param $schedule_id
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSchedulesById($schedule_id)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, $schedule_id);

        return $this->httpGet($url, [], $this->getHeader());
    }

    /**
     * 获取定时任务对应的所有 msg_id.
     *
     * @param $schedule_id
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMsgId($schedule_id)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, $schedule_id.'/msg_ids');

        return $this->httpGet($url, [], $this->getHeader());
    }

    /**
     *  修改指定的 Schedule.
     *
     * @param $schedule_id
     * @param $options
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateSchedules($schedule_id, $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, $schedule_id);

        return $this->httpPut($url, $options, $this->getHeader());
    }

    /**
     * 删除指定的 Schedule 任务
     *
     * @param $schedule_id
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteSchedules($schedule_id)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, $schedule_id);

        return $this->httpDelete($url, $this->getHeader());
    }
}
