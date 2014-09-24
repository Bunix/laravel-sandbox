<?php
namespace App\Services\Alert;

/*
 * This class defines abstract Alert methods
 */

/**
 * Class AlertAbstract
 * @package RightStart\Services\Alert
 */
abstract class AlertAbstract
{
    // Mailer Object
    protected $_mailer;

    // Alert Properties
    protected $_alert_email;
    protected $_alert_level;
    protected $_it_department_email;
    protected $_subject_header;


    /**
     * Alert Abstract Constructor
     *
     */
    public function __construct()
    {
        $this->_it_department_email = \Config::get('alert.emails.it_department');
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
        if(!is_null($email))
            $this->_alert_email = $email;

        // Check for optional alert level override
        if(!is_null($alert_level))
            $this->_alert_level = $alert_level;

        // Set mailer to
        $this->_mailer->to( $this->_alert_email);

        // Add IT Dept to email if set
        if($add_it_dept)
            $this->_mailer->to( $this->_it_department_email);

        // Finish mail build and send
        $this->_mailer->subject($this->_subject_header.$this->_alert_level.': '.$subject)->setBodyData($message)->send();

        return true;
    }



}