<?php

namespace App\Services;

use Exception;

/**
 * Class ServiceLoggerTrait
 *
 * Create Logs for Services
 *
 * @package App\Services\Support\Logger
 */
trait ServiceLoggerTrait
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
            \Logger::write($message, $this->getServiceName(), $this->isSupportService(), 'info', $log_name);
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
            \Logger::write($message, $this->getServiceName(), $this->isSupportService(), 'warning', $log_name);
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
            \Logger::write($message, $this->getServiceName(), $this->isSupportService(), 'error', $log_name);
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
        \Logger::write('Logger Error:' . $error->getMessage(), 'logger', true, 'error');
    }

}