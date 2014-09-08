<?php
namespace RightStart\Services\Logger;

/**
 * Class LoggerTrait
 * @package RightStart\Services\Logger
 *
 * Trait to add logging functionality to any class
 *
 */
trait LoggerTrait
{

    /**
     * Write Success Log
     *
     * @param $message
     */
    private function _logSuccess($message)
    {
        try {
            \Logger::write($message, $this->getSuccessLog(), 'info');
        }
        catch(\Exception $e) {
            \Logger::write('Logger Error:'.$e->getMessage(), 'Logger_Error', 'error');
        }
    }

    /**
     * Write Error Log
     *
     * @param $message
     */
    private function _logError($message)
    {
        try {
            \Logger::write($message, $this->getErrorLog(), 'error');
        }
        catch(\Exception $e) {
            \Logger::write('Logger Error:'.$e->getMessage(), 'Logger_Error', 'error');
        }
    }

    /**
     * Get Success Log
     *
     * @throws \Exception
     * @return mixed
     */
    private function getSuccessLog()
    {
        if (!isset($this->_success_log)){
            throw new \Exception("Success Log not set in class:". get_called_class());
        }
        return $this->_success_log;
    }

    /**
     * Set Success Log
     *
     * @param $log_name
     */
    private function setSuccessLog($log_name)
    {
        $this->_success_log = $log_name;
    }

    /**
     *
     * Get Error Log
     *
     * @throws \Exception
     * @return mixed
     */
    private function getErrorLog()
    {
        if (!isset($this->_error_log)){
            throw new \Exception("Error Log not set in class:". get_called_class());
        }
        return $this->_error_log;
    }

    /**
     * Set Error Log
     *
     * @param $log_name
     */
    private function setErrorLog($log_name)
    {
        $this->_error_log = $log_name;
    }

}