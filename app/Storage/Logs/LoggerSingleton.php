<?php
namespace App\Storage\Logs;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerSingleton {
    private static $instance = null;

    public static function getInstance(): Logger {
        if (self::$instance === null) {
            self::$instance = new Logger('mi_app');
            self::$instance->pushHandler(new StreamHandler(__DIR__ . '/../app.log', Logger::DEBUG));
        }

        return self::$instance;
    }

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}
}
