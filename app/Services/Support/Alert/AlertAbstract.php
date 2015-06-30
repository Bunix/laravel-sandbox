<?php

namespace App\Services\Support\Alert;

use Larablocks\Pigeon\PigeonInterface;

/**
 * Class AlertAbstract
 *
 * @package App\Services\Support\Alert
 *
 * This class defines the abstract Alert Service
 *
 */
abstract class AlertAbstract
{

    /**
     * Mailer Instance
     *
     * @Larablocks\Pigeon\PigeonInterface;
     */
    protected $mailer;

    // Alert Settings
    protected $email_enabled;
    protected $text_enabled;

    // Alert Message Properties
    protected $alert_email;
    protected $alert_level;
    protected $subject_header;

    /**
     * Alert Abstract Constructor
     *
     * @param PigeonInterface $mailer
     */
    public function __construct(PigeonInterface $mailer)
    {
        $this->mailer = $mailer;
        $this->email_enabled = (bool)config('support.alert.enabled.email');
        $this->text_enabled = (bool)config('support.alert.enabled.text');
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
    abstract public function alert($message, $subject, $alert_level = null, $contacts = null);

    /**
     * Send Alert Email
     *
     * @param $subject
     * @param $message
     * @param null $alert_level
     * @param null $contacts
     * @return bool
     */
    protected function emailAlert($message, $subject = null, $alert_level = null, $contacts = null)
    {
        // Check if email enabled
        if ($this->email_enabled) {

            // Check for optional email override
            /*if (is_array($contacts)) {
                $this->alert_email = $contacts;
            } else {
                $this->alert_email = $contacts;
            }*/

            // Check for optional alert level override
            if (!is_null($alert_level)) {
                $this->alert_level = $alert_level;
            }

            // Set Subject
            if (!is_null($subject)) {
                $this->mailer->subject($subject);
            }

            return $this->mailer->type('alert')->to($this->alert_email)->pass(['_message' => $message])->send();
        }

        return false;
    }

    /**
     * Send Alert Text
     *
     * @param $message
     * @param null $alert_level
     * @param null $contacts
     * @return bool
     */
    protected function textAlert($message, $alert_level = null, $contacts = null)
    {
        return true;
    }


}