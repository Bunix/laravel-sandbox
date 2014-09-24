<?php
namespace App\Services\Logger;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


/**
 * Class MyLogger
 * @package App\Services\Logger
 *
 * Log Class to write general individual log files
 *
 */
class MyLogger implements LoggerInterface
{

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