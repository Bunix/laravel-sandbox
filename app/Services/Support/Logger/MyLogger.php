<?php

namespace App\Services\Support\Logger;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class MyLogger
 *
 * @package App\Services\Logger
 *
 * Log Class to write general individual log files
 *
 * 3 levels (info, warning, error)
 *
 */
class MyLogger implements LoggerInterface
{

    /**
     * Logs Enabled Flag
     *
     * @var bool
     */
    private $all_logs_enabled;

    /**
     * Global Error Log Enabled Flag
     *
     * @var bool
     */
    private $global_error_log_enabled;


    /**
     * Logger Abstract Constructor
     *
     */
    public function __construct()
    {
        $this->all_logs_enabled = (bool)config('support.logger.enabled.all_logs');
        $this->global_error_log_enabled = (bool)config('support.logger.enabled.global_error_log');
    }


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
    public function write($message, $level = 'info', $log_path = null, $log_title = '')
    {
        if ($this->all_logs_enabled) {

            if (is_null($log_path)) {
                $log_path = storage_path() . '/logs/general.log';
            }

            $log_event = \App::make('log_event_time');

            // Write main log
            $service_log = new Logger($log_event);
            $service_log->pushHandler(new StreamHandler($log_path, Logger::INFO));
            $service_log->log($level, $message);

            // If error level log also write to master error log
            if ($level == 'error' && $this->global_error_log_enabled) {
                $error_log = new Logger($log_event . '-' . $log_title);
                $error_log->pushHandler(new StreamHandler(storage_path() . '/logs/all-errors.log', Logger::ERROR));
                $error_log->log($level, $message);
            }
        }

        return true;
    }

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
    public function writeService($message, $level = 'info', $log_name = 'general.log', $is_support = false, $service_name)
    {
        if ($this->all_logs_enabled) {

            $log_path = storage_path() . '/logs/';

            // Add support folder
            if ($is_support) {
                $log_path .= 'support/';
                $this->makeDir($log_path);
            }

            // Format service name for logs
            $service_name = strtolower(str_replace(' ', '_', $service_name));

            // Add service name
            $log_path .= $service_name . '/';
            $this->makeDir($log_path);

            // Add file name
            if (!is_null($log_name)) {
                $log_path .= $log_name;
            } else {
                switch ($level) {
                    case 'info':
                        $log_path .= $service_name . '-info.log';
                        break;
                    case 'warning':
                        $log_path .= $service_name . '-warning.log';
                        break;
                    case 'error':
                        $log_path .= $service_name . '-error.log';
                        break;
                    default:
                        $log_path .= $service_name . '.log';
                }
            }

            $this->write($message, $level, $log_path, $service_name);
        }

        return true;
    }

    /**
     * Log Command Message
     *
     * @param $message
     * @param string $level
     * @param string $log_name
     * @param $command_name
     * @return bool
     */
    public function writeCommand($message, $level = 'info', $log_name = 'general.log', $command_name)
    {
        if ($this->all_logs_enabled) {

            $log_path = storage_path() . '/logs/commands/';

            $this->makeDir($log_path);

            // Format service name for logs
            $command_name = strtolower(str_replace(' ', '_', $command_name));

            // Add command name
            $log_path .= $command_name . '/';
            $this->makeDir($log_path);

            // Add file name
            if (!is_null($log_name)) {
                $log_path .= $log_name;
            } else {
                switch ($level) {
                    case 'info':
                        $log_path .= $command_name . '-info.log';
                        break;
                    case 'warning':
                        $log_path .= $command_name . '-warning.log';
                        break;
                    case 'error':
                        $log_path .= $command_name . '-error.log';
                        break;
                    default:
                        $log_path .= $command_name . '.log';
                }
            }

            $this->write($message, $level, $log_path, $command_name);
        }

        return true;
    }

    /**
     * Make Dir
     *
     * @param $path
     */
    private function makeDir($path)
    {
        if (!is_dir($path)) {
            mkdir($path);
        }
    }
}