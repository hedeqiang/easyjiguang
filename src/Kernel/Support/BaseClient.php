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

use EasyJiGuang\Kernel\Exceptions\InvalidConfigException;
use EasyJiGuang\Kernel\ServiceContainer;
use EasyJiGuang\Kernel\Traits\HasHttpRequests;
use EasyJiGuang\Kernel\Traits\string;
use GuzzleHttp\Exception\GuzzleException;
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
     *
     * @param ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * GET request.
     *
     * @param string $url
     * @param array  $query
     * @param array  $headers
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    protected function httpGet(string $url, array $query, array $headers)
    {
        return $this->request($url, 'GET', ['query' => $query, 'headers' => $headers]);
    }

    /**
     * POST request.
     *
     * @param string $url
     * @param array  $data
     * @param array  $headers
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return ResponseInterface
     */
    protected function httpPost(string $url, array $data = [], array $headers = [])
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
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    protected function httpDelete(string $url, array $headers, array $query = [])
    {
        return $this->request($url, 'DELETE', [
            'headers' => $headers,
            'query'   => $query,
        ]);
    }

    /**
     * JSON request.
     *
     * @param string $url
     * @param array  $data
     * @param array  $headers
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    protected function httpPostJson(string $url, array $data, array $headers)
    {
        return $this->request($url, 'POST', ['headers' => $headers, 'json' => $data]);
    }

    /****
     * PUT request.
     * @param  string  $url
     * @param  array   $data
     * @param  array   $headers
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws GuzzleException
     * @throws InvalidConfigException
     */
    protected function httpPut(string $url, array $data, array $headers)
    {
        return $this->request($url, 'PUT', ['headers' => $headers, 'json' => $data]);
    }

    /****
     * 上传文件
     * Upload file.
     *
     * @param  string  $url
     * @param  array   $files
     * @param  array   $headers
     * @param  array   $form
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws GuzzleException
     * @throws InvalidConfigException
     */
    protected function httpUpload(string $url, array $files, array $headers, array $form = [])
    {
        $multipart = [];
        foreach ($files as $name => $path) {
            $multipart[] = [
                'name'     => $name,
                'contents' => fopen($path, 'r'),
            ];
        }

        foreach ($form as $name => $contents) {
            $multipart[] = compact('name', 'contents');
        }

        return $this->request(
            $url,
            'POST',
            ['multipart' => $multipart, 'headers' => $headers, 'connect_timeout' => 30, 'timeout' => 30, 'read_timeout' => 30]
        );
    }

    /****
     * @param  string  $url
     * @param  string  $method
     * @param  array   $options
     * @param  false   $returnRaw
     *
     * @return array|Collection|string|object|ResponseInterface
     * @throws GuzzleException
     * @throws InvalidConfigException
     */
    protected function request(string $url, string $method = 'GET', array $options = [], bool $returnRaw = false)
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
     * @param string $type
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
            return base64_encode($this->app->config->get('devKey').':'.$this->app->config->get('devSecret'));
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
