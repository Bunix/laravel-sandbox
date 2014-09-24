<?php
namespace App\Services\Alert\Admin;

use App\Services\Alert\AlertAbstract;
use App\Services\Alert\AlertInterface;
use App\Services\Mailer\Alert\AlertEmail;

/**
 * Class AdminAlert
 * @package RightStart\Services\Alert\App
 */
class AdminAlert extends AlertAbstract implements AlertInterface
{

    /**
     * Webops Alert Constructor
     *
     * @param AlertEmail $mailer
     */
    public function __construct(AlertEmail $mailer)
    {
        // Set properties
        $this->_mailer = $mailer;
        $this->_alert_email = \Config::get('alert.type.admin.email');
        $this->_alert_level = \Config::get('alert.type.admin.level');
        $this->_subject_header = \Config::get('alert.type.admin.subject.header');

        parent::__construct();
    }

    /**
     * Call Alert for Subclass
     *
     * Just passes the config email for subclass with the
     * other variables to parent method
     *
     * @param $subject
     * @param $message
     * @param null $alert_level
     * @param null $contact
     * @return mixed
     */
    public function alert($subject, $message, $alert_level=null, $contact=null)
    {
        parent::emailAlert($subject, $message, $alert_level, $contact);
    }

}