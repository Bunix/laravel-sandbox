<?php
namespace App\Services\Alert\App;

trait AppAlertTrait
{

    /**
     * Webops Alert
     *
     * @param $subject
     * @param $message
     * @param null $alert_level
     * @param int $add_it_dept
     * @param null $contact
     */
    private function _webopsAlert($subject, $message, $alert_level=null, $add_it_dept=0, $contact=null)
    {
        $alert = \App::make('WebopsAlert');
        $alert->alert($subject, $message, $alert_level,$add_it_dept, $contact);
    }
}