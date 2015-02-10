<?php namespace App\Services\Support\Alert\Type;

use App\Services\Support\Alert\AlertAbstract;
use App\Services\Support\Mailer\Alert\AlertEmail;

/**
 * Class WebopsAlert
 * @package App\Services\Support\Alert\Type
 */
class WebopsAlert extends AlertAbstract
{

    /**
     * Webops Alert Constructor
     *
     * @param AlertEmail $mailer
     */
    public function __construct(AlertEmail $mailer)
    {
        // Set properties
        $this->mailer = $mailer;
        $this->alert_email = \Config::get('alert.type.webops.email');
        $this->alert_level = \Config::get('alert.type.webops.level');
        $this->subject_header = \Config::get('alert.type.webops.subject.header');

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
     * @param null $contacts
     * @return mixed
     */
    public function alert($subject, $message, $alert_level=null, $contacts=null)
    {
        parent::emailAlert($subject, $message, $alert_level, $contacts);
    }

}