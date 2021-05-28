<?php

/*
 * This file is part of the hedeqiang/jpush.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JVerify;

use EasyJiGuang\Kernel\Support\BaseClient;

class Client extends BaseClient
{

    const ENDPOINT_TEMPLATE = 'https://api.verification.jpush.cn/v1/';

    const ENDPOINT_VERSION = 'v1';


    /**
     * 号码认证
     *
     * @param array $options
     * @param string $type
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function verify(array $options, string $type = 'Android、iOS')
    {
        /*$options = [
                'token' => $token,
                'phone' => $phone,
                'exID' => $exID,
          ];*/

        if ($type === 'Web'){
            $action = 'web/h5/verify';
        }else{
            $action = 'web/verify';
        }
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, $action);
        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 一键登录
     *
     * @param string $loginToken
     * @param $exID
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function loginTokenVerify(string $loginToken,$exID)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'web/loginTokenVerify');
        $options = [
            'loginToken' => $loginToken,
            'exID' => $exID,
        ];
        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 解密手机号
     * @param $encrypted
     * @return string[]
     */
    public function decrzypt(string $encrypted): array
    {
        $prefix = '-----BEGIN RSA PRIVATE KEY-----';
        $suffix = '-----END RSA PRIVATE KEY-----';
        $result = '';

        $prikey = $this->config->get('priKey');

        $key = $prefix . "\n" . $prikey . "\n" . $suffix;
        $r = openssl_private_decrypt(base64_decode($encrypted), $result, openssl_pkey_get_private($key));
        return ['phone' => $result];
    }


}
