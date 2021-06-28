<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Hedeqiang\JPush;

use Hedeqiang\JPush\Exceptions\HttpException;
use Hedeqiang\JPush\Traits\HasHttpRequest;

class JPush extends Base
{
    use HasHttpRequest;

    const ENDPOINT_TEMPLATE = 'https://api.jpush.cn/v3';

    const ENDPOINT_VERSION = 'v3';

    /**
     * 向某单个设备或者某设备列表推送一条通知、或者消息。
     *
     * @throws HttpException
     *
     * @return array
     */
    public function message(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push');

        try {
            return $this->postJson($url, $options, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 推送唯一标识符.
     *
     * @throws HttpException
     *
     * @return array
     */
    public function getCid(array $query)
    {
        /*$query = [
            'count' => $count,
            'type'  => $type,
        ];*/
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/cid');

        try {
            return $this->get($url, $query, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 推送校验 API.
     *
     * @param $options
     *
     * @throws HttpException
     *
     * @return array
     */
    public function validate(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/validate');

        try {
            return $this->postJson($url, $options, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 批量单推  针对的是RegID方式批量单推.
     *
     * @throws HttpException
     *
     * @return array
     */
    public function batchRegidSingle(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/batch/regid/single');

        try {
            return $this->postJson($url, $options, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 针对的是Alias方式批量单推.
     *
     * @throws HttpException
     *
     * @return array
     */
    public function batchAliasSingle(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/batch/alias/single');

        try {
            return $this->postJson($url, $options, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 推送撤销
     *
     * @param $msgid
     *
     * @throws HttpException
     *
     * @return array
     */
    public function revoke($msgid)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/'.$msgid);

        try {
            return $this->delete($url, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 文件推送
     *
     * @throws HttpException
     *
     * @return array
     */
    public function file(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/file');

        try {
            return $this->postJson($url, $options, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Group Push API：应用分组推送
     *
     * @throws HttpException
     *
     * @return array
     */
    public function groupPush(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'grouppush');

        try {
            return $this->postJson($url, $options, $this->getHeader('group'));
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 应用分组文件推送（VIP专属接口）.
     *
     * @throws HttpException
     *
     * @return array
     */
    public function groupPushFile(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'grouppush/file');

        try {
            return $this->postJson($url, $options, $this->getHeader('group'));
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
