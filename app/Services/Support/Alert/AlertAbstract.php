<?php namespace App\Services\Support\Alert;

/*
 * This class defines abstract Alert methods
 */

/**
 * Class AlertAbstract
 * @package RightStart\Services\Support\Alert
 */
abstract class AlertAbstract
{
    // Mailer Object
    protected $mailer;

    // Alert Properties
    protected $alert_email;
    protected $alert_level;
    protected $it_department_email;
    protected $subject_header;
    protected $enabled;


    /**
     * Alert Abstract Constructor
     *
     */
    public function __construct()
    {
        $this->it_department_email = \Config::get('alert.emails.it_department');
        $this->enabled= \Config::get('alert.enabled');
    }

    /**
     * Abstract Alert Method
     *
     * @param $subject
     * @param $message
     * @param $alert_level
     * @param $add_it_dept
     * @param $contact
     * @return mixed
     */
    abstract public function alert($subject, $message, $alert_level, $add_it_dept, $contact);

    /**
     * Send Alert Email
     *
     * @param $subject
     * @param $message
     * @param null $alert_level
     * @param int $add_it_dept
     * @param null $email
     * @return mixed
     */
    protected function emailAlert($subject, $message, $alert_level=null, $add_it_dept=0, $email=null)
    {
        // Check for optional email override
        if (!is_null($email)) {
            $this->alert_email = $email;
        }

        // Check for optional alert level override
        if (!is_null($alert_level)) {
            $this->alert_level = $alert_level;
        }

        // Set mailer to
        $this->mailer->to( $this->alert_email);

        // Add IT Dept to email if set
        if ($add_it_dept) {
            $this->mailer->to($this->it_department_email);
        }

        // Finish mail build and send
        if($this->enabled) {
            $this->mailer->subject($this->subject_header . $this->alert_level . ': ' . $subject)->setBodyData($message)->send();
        }

        return true;
    }



}