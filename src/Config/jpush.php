<?php

/*
 * This file is part of the hedeqiang/jpush.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

return [
    'appKey' => env('JPUSH_APP_KEY'),
    'masterSecret' => env('JPUSH_MASTER_SECRET'),

    'groupKey' => env('JPUSH_GROUP_KEY'),
    'groupSecret' => env('JPUSH_GROUP_SECRET'),

    'devKey' => env('JPUSH_DEV_KEY'),
    'devSecret' => env('JPUSH_DEV_SECRET'),
];
