<?php namespace App\Services\Alert;

interface AlertInterface
{
    /**
     * Send Alert Email
     *
     * @param $subject
     * @param $message
     * @param $alert_level
     * @param null $contact
     * @return mixed
     */
    public function alert($subject, $message, $alert_level, $contact);

}