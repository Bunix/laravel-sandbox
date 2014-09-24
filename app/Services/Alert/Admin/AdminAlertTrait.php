<?php
namespace App\Services\Alert\Admin;

trait AppAlertTrait
{

    /**
     * Admin Alert
     *
     * @param $subject
     * @param $message
     * @param null $alert_level
     * @param null $contact
     */
    private function _adminAlert($subject, $message, $alert_level=null, $contact=null)
    {
        $alert = \App::make('AdminAlert');
        $alert->alert($subject, $message, $alert_level, $contact);
    }
}