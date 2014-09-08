<?php namespace RightStart\Services\Logger;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/*
 * This class defines abstract Mailer methods
 */

class RightStartLogger implements LoggerInterface {


    /**
     * Log Message
     *
     * @param $message
     * @param $log_name
     * @param string $error_level
     * @return boolean
     */
    public function write($message, $log_name, $error_level='info')
    {
        $view_log = new Logger($log_name);
        $view_log->pushHandler(new StreamHandler(storage_path().'/logs/'.$log_name.'.log', Logger::INFO));
        $view_log->log($error_level, $message);

        return true;
    }

}