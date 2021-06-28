<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\Kernel\Events;

use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpResponseCreated.
 */
class HttpResponseCreated
{
    /**
     * @var ResponseInterface
     */
    public $response;

    /****
     * HttpResponseCreated constructor.
     *
     * @param  ResponseInterface  $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }
}
