<?php
/**
 *
 * @author yupoxiong<i@yupoxiong.com>
 */

return [
    // pid file
    'pid_file' => app()->getRootPath() . env('chat_pid_file', 'chat.pid'),
    // Register配置
    'register' => [
        'run'  => env('chat_run_register', true),
        'ip'   => env('chat_register_ip', '127.0.0.1'),
        'port' => env('chat_register_port', 1234),
    ],
    // BusinessWorker配置
    'worker'   => [
        'run'           => env('chat_run_worker', true),
        'name'          => env('chat_worker_name', 'ChatBusinessWorker'),
        'count'         => env('chat_worker_count', 4),
        'event_handler' => env('chat_worker_event_handler', '\app\command\event\ChatEvent'),
    ],
    // Gateway配置
    'gateway'  => [
        'run'                     => env('chat_run_gateway', true),
        'port'                    => env('chat_gateway_port', 2001),
        'start_port'              => env('chat_gateway_start_port', 2002),
        'name'                    => env('chat_gateway_name', 'ChatGateway'),
        'count'                   => env('chat_gateway_count', 2),
        'lan_ip'                  => env('chat_gateway_lan_ip','127.0.0.1'),
        'ping_data'               => env('chat_gateway_ping_data', '1'),
        'ping_interval'           => env('chat_gateway_ping_interval', 10),
        'ping_not_response_limit' => env('chat_gateway_ping_not_response_limit', 1),
    ],

];
