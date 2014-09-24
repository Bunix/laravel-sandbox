<?php
namespace App\Services\Logger;

interface LoggerInterface
{

    /**
     * Write to appropriate log
     *
     * @param $message
     * @param $file_name
     * @param $error_level
     * @return bool
     */
    public function write($message,$file_name, $error_level);

}