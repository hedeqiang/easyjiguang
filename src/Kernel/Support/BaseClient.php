<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\Kernel\Support;

use EasyJiGuang\Kernel\ServiceContainer;
use EasyJiGuang\Kernel\Traits\HasHttpRequests;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LogLevel;

abstract class BaseClient
{
    use HasHttpRequests {
        HasHttpRequests::request as performRequest;
    }

    protected $config;

    /**
     * @var ServiceContainer
     */
    private $app;

    /**
     * BaseClient constructor.
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * GET request.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function httpGet(string $url, array $query, array $headers)
    {
        return $this->request($url, 'GET', ['query' => $query, 'headers' => $headers]);
    }

    /**
     * POST request.
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function httpPost(string $url, array $data = [], array $headers)
    {
        return $this->request($url, 'POST', ['form_params' => $data, 'headers' => $headers]);
    }

    /***
     * DELETE request.
     *
     * @param string $url
     * @param array $headers
     * @param array $query
     * @return array|Collection|object|ResponseInterface|string
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function httpDelete(string $url, array $headers, array $query = [])
    {
        return $this->request($url, 'DELETE', [
            'headers' => $headers,
            'query' => $query,
        ]);
    }

    /**
     * JSON request.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function httpPostJson(string $url, array $data, array $headers)
    {
        return $this->request($url, 'POST', ['headers' => $headers, 'json' => $data]);
    }

    /**
     * PUT request.
     *
     * @return array|Collection|object|ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function httpPut(string $url, array $data, array $headers)
    {
        return $this->request($url, 'PUT', ['headers' => $headers, 'json' => $data]);
    }

    /**
     * 上传文件
     * Upload file.
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function httpUpload(string $url, array $files, array $headers, array $form = [])
    {
        $multipart = [];
        foreach ($files as $name => $path) {
            $multipart[] = [
                'name' => $name,
                'contents' => fopen($path, 'r'),
            ];
        }

        foreach ($form as $name => $contents) {
            $multipart[] = compact('name', 'contents');
        }

        return $this->request(
            $url, 'POST', ['multipart' => $multipart, 'headers' => $headers, 'connect_timeout' => 30, 'timeout' => 30, 'read_timeout' => 30]
        );
    }

    /**
     * @param false $returnRaw
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \GuzzleHttp\Exception\GuzzleException|\EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     */
    protected function request(string $url, string $method = 'GET', array $options = [], $returnRaw = false)
    {
        if (empty($this->middlewares)) {
            $this->registerHttpMiddlewares();
        }

        $response = $this->performRequest($url, $method, $options);

        return $returnRaw ? $response : $this->castResponseToType($response, $this->app->config->get('response_type'));
    }

    /**
     * Register Guzzle middlewares.
     */
    protected function registerHttpMiddlewares()
    {
        // retry
        $this->pushMiddleware($this->retryMiddleware(), 'retry');
        // log
        $this->pushMiddleware($this->logMiddleware(), 'log');
    }

    /**
     * Log the request.
     */
    protected function logMiddleware(): callable
    {
        $formatter = new MessageFormatter($this->app['config']['http.log_template'] ?? MessageFormatter::DEBUG);

        return Middleware::log($this->app['logger'], $formatter, LogLevel::DEBUG);
    }

    /**
     * Return retry middleware.
     */
    protected function retryMiddleware(): callable
    {
        return Middleware::retry(
            function (
                $retries,
                RequestInterface $request,
                ResponseInterface $response = null
            ) {
                // Limit the number of retries to 2
                // Retry on server errors
                return $retries < $this->app->config->get(
                        'http.max_retries',
                        1
                    ) && $response && $response->getStatusCode() >= 500;
            },
            function () {
                return abs($this->app->config->get('http.retry_delay', 500));
            }
        );
    }

    /**
     * 获取 Header.
     *
     * @param  string  $type
     *
     * @return string[]
     */
    protected function getHeader(string $type = 'app'): array
    {
        return [
            'Authorization' => 'Basic '.$this->getAuthStr($type),
        ];
    }

    protected function getAuthStr(string $type): string
    {
        if ('app' === $type) {
            return base64_encode($this->app->config->get('appKey').':'.$this->app->config->get('masterSecret'));
        } elseif ('group' === $type) {
            // group
            return base64_encode($this->app->config->get('groupKey').':'.$this->app->config->get('groupSecret'));
        } elseif ('dev' === $type) {
            return base64_encode($this->app->configg->get('devKey').':'.$this->app->config->get('devSecret'));
        }
    }

    /**
     * Build endpoint url.
     */
    protected function buildEndpoint(string $url, string $action): string
    {
        return $url.'/'.$action;
    }
}
