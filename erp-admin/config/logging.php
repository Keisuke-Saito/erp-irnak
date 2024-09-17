<?php

use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['daily', 'daily_error'],
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
        ],

        'daily' => [
            'driver' => 'daily',
            'tap' => [App\Logging\LogFormatter::class],
            'path' => storage_path('logs/dairy/info.log'),
            'level' => 'debug',
            'days' => 14,
            'permission' => 0664,
        ],

        'daily_error' => [
            'driver' => 'daily',
            'tap' => [App\Logging\LogFormatter::class],
            'path' => storage_path('logs/dairy/error.log'),
            'level' => 'error',
            'days' => 14,
            'permission' => 0664,
        ],

        'action' => [
            'driver' => 'daily',
            'tap' => [App\Logging\ActionLogFormatter::class],
            'path' => storage_path('logs/dairy/info.log'),
            'level' => 'debug',
            'days' => 14,
            'permission' => 0664,
        ],

        'batch' => [
            'driver' => 'daily',
            'tap' => [App\Logging\BatchLogFormatter::class],
            'path' => storage_path('logs/batch/batch.log'),
            'level' => 'debug',
            'days' => 14,
            'permission' => 0664,
        ],

        'batch_error' => [
            'driver' => 'daily',
            'tap' => [App\Logging\BatchLogFormatter::class],
            'path' => storage_path('logs/batch/error.log'),
            'level' => 'error',
            'days' => 14,
            'permission' => 0664,
        ],

        'sqllog' => [
            'driver' => 'daily',
            'tap' => [App\Logging\QueryLogFormatter::class],
            'path' => storage_path('logs/sql/sql.log'),
            'level' => 'debug',
            'days' => 14,
            'permission' => 0664,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => 'critical',
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => 'debug',
            'handler' => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => 'debug',
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => 'debug',
        ],
    ],

];