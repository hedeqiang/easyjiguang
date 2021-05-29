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

class Admin extends Base
{
    use HasHttpRequest;

    const ENDPOINT_TEMPLATE = 'https://admin.jpush.cn/v1/app';

    const ENDPOINT_VERSION = 'v1';

    /**
     * 创建极光 app.
     *
     * @param $options
     *
     * @return array
     *
     * @throws HttpException
     */
    public function createApp($options)
    {
        try {
            return $this->postJson(self::ENDPOINT_TEMPLATE,
                $options, $this->getHeader('dev'));
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * app 删除.
     *
     * @return array
     *
     * @throws HttpException
     */
    public function deleteApp(string $appKey)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, $appKey.'/delete');
        try {
            return $this->delete(self::ENDPOINT_TEMPLATE.'/'.$url,
                [], $this->getHeader('dev'));
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 证书上传.
     *
     * @return array
     *
     * @throws HttpException
     */
    public function uploadCertificate(string $appKey, array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, $appKey.'/certificate');
        try {
            return $this->post($url, $options, $this->getHeader('dev'));
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
