<?php

namespace App\Console\Commands;

use Exception;

/**
 * Class CommandLoggerTrait
 * @package App\Services
 */
trait CommandLoggerTrait
{
    /**
     * Write Info Log
     *
     * @param $message
     * @param null $log_name
     * @return bool
     */
    protected function logInfo($message, $log_name = null)
    {
        try {
            \Logger::writeCommand($message, 'info', $log_name, strtolower($this->getCommandName()));
        } catch (Exception $e) {
            $this->loggingError($e);
        }

        return true;
    }

    /**
     * Write Warning Log
     *
     * @param $message
     * @param null $log_name
     * @return bool
     */
    protected function logWarning($message, $log_name = null)
    {
        try {
            \Logger::writeCommand($message, 'warning', $log_name, strtolower($this->getCommandName()));
        } catch (Exception $e) {
            $this->loggingError($e);
        }

        return true;
    }

    /**
     * Write Error Log
     *
     * @param $message
     * @param null $log_name
     * @return bool
     */
    protected function logError($message, $log_name = null)
    {
        try {
            \Logger::writeCommand($message, 'error', $log_name, strtolower($this->getCommandName()));
        } catch (Exception $e) {
            $this->loggingError($e);
        }

        return true;
    }

    /**
     * Log Logging Error
     *
     * @param $error
     */
    private function loggingError($error)
    {
        \Logger::write('Logger Error:' . $error->getMessage(), 'info', storage_path() . '/logs/logger-errors.log');
    }

}