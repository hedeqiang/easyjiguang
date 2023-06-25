<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JEmail;

use EasyJiGuang\Kernel\Support\BaseClient;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://api.sendcloud.net/apiv2/';

    public function send()
    {
    }
}
