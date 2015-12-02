<?php

namespace App\Services\Support\Logger;

interface LoggerInterface
{
    /**
     * Log Message
     *
     * @param $message
     * @param string $level
     * @param string $log_path
     * @param string $log_title
     * @return bool
     * @internal param string $log_name
     */
    public function write($message, $level = 'info', $log_path = null, $log_title = '');

    /**
     * Log Service Message
     *
     * @param $message
     * @param string $level
     * @param string $log_name
     * @param bool|false $is_support
     * @param $service_name
     * @return bool
     */
    public function writeService($message, $level = 'info', $log_name = 'service.log', $is_support = false, $service_name);

}