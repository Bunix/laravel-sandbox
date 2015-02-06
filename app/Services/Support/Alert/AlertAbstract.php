<?php namespace App\Services\Support\Alert;

/*
 * This class defines abstract Alert methods
 */

/**
 * Class AlertAbstract
 * @package App\Services\Support\Alert
 */
abstract class AlertAbstract
{
    // Mailer Object
    protected $mailer;

    // Alert Properties
    protected $alert_email;
    protected $alert_level;
    protected $subject_header;
    protected $enabled;


    /**
     * Alert Abstract Constructor
     *
     */
    public function __construct()
    {
        $this->enabled= \Config::get('alert.enabled');
    }

    /**
     * Abstract Alert Method
     *
     * @param $subject
     * @param $message
     * @param $alert_level
     * @param $contacts
     * @return
     */
    abstract public function alert($subject, $message, $alert_level=null, $contacts=null);

    /**
     * Send Alert Email
     *
     * @param $subject
     * @param $message
     * @param null $alert_level
     * @param null $contacts
     * @return bool
     */
    protected function emailAlert($subject, $message, $alert_level=null, $contacts=null)
    {
        // Check for optional email override
        if (is_array($contacts)) {
            $this->alert_email = $email;
        } else {
            $this->alert_email = $contacts;
        }

        // Check for optional alert level override
        if (!is_null($alert_level)) {
            $this->alert_level = $alert_level;
        }

        // Set mailer to
        $this->mailer->to( $this->alert_email);

        // Finish mail build and send
        if($this->enabled) {
            $this->mailer->subject($this->subject_header . $this->alert_level . ': ' . $subject)->setBodyData($message)->send();
        }

        return true;
    }

    /**
     * Send Alert Email
     *
     * @param $subject
     * @param $message
     * @param null $alert_level
     * @param null $contacts
     * @return bool
     */
    protected function textAlert($subject, $message, $alert_level=null, $contacts=null)
    {
        // Check for optional email override
        if (is_array($contacts)) {
            $this->alert_email = $email;
        } else {
            $this->alert_email = $contacts;
        }

        // Check for optional alert level override
        if (!is_null($alert_level)) {
            $this->alert_level = $alert_level;
        }

        // Set mailer to
        $this->mailer->to( $this->alert_email);

        // Finish mail build and send
        if($this->enabled) {
            $this->mailer->subject($this->subject_header . $this->alert_level . ': ' . $subject)->setBodyData($message)->send();
        }

        return true;
    }



}