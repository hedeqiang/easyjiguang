<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JUms;

use EasyJiGuang\Kernel\Support\BaseClient;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://api.ums.jiguang.cn/v1/broadcast';

    //const ENDPOINT_TEMPLATE = 'https://api.ums.jiguang.cn/v1/sent';
}
