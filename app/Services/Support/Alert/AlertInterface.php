<?php namespace App\Services\Support\Alert;

interface AlertInterface
{
    /**
     * Send Alert Email
     *
     * @param $subject
     * @param $message
     * @param $alert_level
     * @param $add_it_dept
     * @param null $contact
     * @return mixed
     */
    public function alert($subject, $message, $alert_level, $add_it_dept, $contact);

}