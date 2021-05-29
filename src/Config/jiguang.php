<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
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

    /*
     * 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
     */
    'response_type' => 'array',

    /*
     * 日志配置
     *
     * level: 日志级别, 可选为：
     *         debug/info/notice/warning/error/critical/alert/emergency
     * path：日志文件位置(绝对路径!!!)，要求可写权限
     */
    'log' => [
        'default' => env('APP_DEBUG', false) ? 'dev' : 'prod', // 默认使用的 channel，生产环境可以改为下面的 prod
        'channels' => [
            // 测试环境
            'dev' => [
                'driver' => 'single',
                'path' => '/tmp/push.log',
                'level' => 'debug',
            ],
            // 生产环境
            'prod' => [
                'driver' => 'daily',
                'path' => '/tmp/push.log',
                'level' => 'info',
            ],
        ],
    ],
];
