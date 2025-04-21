<?php

use App\Storage\Logs\LoggerSingleton;

if (!function_exists('logger')) {
    function logger(): \Monolog\Logger {
        return LoggerSingleton::getInstance();
    }
}
