<?php

namespace App\Services;

use Workerman\Worker;


abstract class WebSocket
{

    public static function timer()
    {
        $h = 0;
        $m = 0;
        $s = 0;
        while (true) {
            $s = $s + 1;
            if ($s ==  60) {
                $s = 0;
                $m = $m + 1;

                if ($m == 60) {
                    $m = 0;
                    $h = $h + 1;
                }
            }
        }
        return "$h:$m:$s";
    }

    public static function run()
    {
        $worker = new Worker('websocket://0.0.0.0:2346');
        // 4 processes
        $worker->count = 1;

        // Emitted when new connection come
        $worker->onConnect = function ($connection) {
            echo "New connection detected\n";
        };

        // Emitted when data received
        $worker->onMessage = function ($connection, $data) {
            $data = json_decode($data, true);
            if (key_exists('action', $data)) {
                if ($data['action'] == 'GET_RANDOM_NUMBER') {
                    while (true) {
                        sleep(5);
                        $connection->send(json_encode([
                            'random' => rand(0, 200),
                            // 'timer' => self::timer()
                        ]));
                    }
                }
            }
        };

        // Emitted when connection closed
        $worker->onClose = function ($connection) {
            echo "Connection closed\n";
        };

        // Run worker
        Worker::runAll();
    }
}
