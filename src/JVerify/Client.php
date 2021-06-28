<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JVerify;

use EasyJiGuang\Kernel\Exceptions\InvalidConfigException;
use EasyJiGuang\Kernel\Support\BaseClient;
use EasyJiGuang\Kernel\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://api.verification.jpush.cn/v1/';

    const ENDPOINT_VERSION = 'v1';

    /**
     * 号码认证
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function verify(array $options, string $type = 'Android、iOS')
    {
        /*$options = [
                'token' => $token,
                'phone' => $phone,
                'exID' => $exID,
          ];*/

        if ('Web' === $type) {
            $action = 'web/h5/verify';
        } else {
            $action = 'web/verify';
        }
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, $action);

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 一键登录.
     *
     * @param string $loginToken
     * @param        $exID
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function loginTokenVerify(string $loginToken, $exID)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'web/loginTokenVerify');
        $options = [
            'loginToken' => $loginToken,
            'exID'       => $exID,
        ];

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 解密手机号.
     *
     * @param string $encrypted
     *
     * @return string[]
     */
    public function decrzypt(string $encrypted): array
    {
        $prefix = '-----BEGIN RSA PRIVATE KEY-----';
        $suffix = '-----END RSA PRIVATE KEY-----';

        $key = $prefix."\n".$this->config->get('priKey')."\n".$suffix;
        $result = openssl_private_decrypt(base64_decode($encrypted), $result, openssl_pkey_get_private($key));

        return ['phone' => $result];
    }
}
