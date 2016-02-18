<?php

namespace App\Services\Support\Alert;

use App\Services\Support\SMS\EmailSMSHandler;
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

    /**
     * SMS Handler Instance
     *
     * @App\Services\Support\SMS\EmailSMSHandler;
     */
    protected $sms_handler;

    /**
     * Email Alert Enabled
     *
     * @var bool
     */
    protected $email_enabled;

    /**
     * Text Alert Enabled
     *
     * @var bool
     */
    protected $text_enabled;

    /**
     * Alert Email
     *
     * @var array
     */
    protected $alert_email = [];

    /**
     * Alert Phone
     *
     * @var string
     */
    protected $alert_phone;

    /**
     * Alert Provider
     *
     * @var string
     */
    protected $alert_provider;

    /**
     * Alert Level
     *
     * @var string
     */
    protected $alert_level;

    /**
     * Alert Subject
     *
     * @var string
     */
    protected $subject_header;

    /**
     * Alert Abstract Constructor
     *
     * @param PigeonInterface $mailer
     * @param EmailSMSHandler $sms_handler
     */
    public function __construct(PigeonInterface $mailer, EmailSMSHandler $sms_handler)
    {
        $this->mailer = $mailer;
        $this->sms_handler = $sms_handler;
        $this->email_enabled = (bool)config('support.alert.enabled.email');
        $this->text_enabled = (bool)config('support.alert.enabled.text');
    }

    /**
     * Abstract Alert Method
     *
     * @param $message
     * @param $subject
     * @param null $alert_level
     * @param array $contacts
     * @return
     */
    abstract public function alert($message, $subject, $alert_level = null, $contacts = []);

    /**
     * Send Alert Email
     * @param $message
     * @param null $subject
     * @param null $alert_level
     * @param array $contacts
     * @return bool
     */
    protected function emailAlert($message, $subject = null, $alert_level = null, $contacts = [])
    {
        // Check if email enabled
        if ($this->email_enabled) {

            $this->mailer->type('alert');

            // Set Subject
            if (!is_null($subject)) {
                $this->mailer->subject($subject);
            }

            // Set Alert Level
            if (!is_null($alert_level)) {
                $alert_level = $this->alert_level;
            }

            // Set Contacts
            if (!empty($contacts)) {
               $this->mailer->to([$contacts]);
            } else {
                $this->mailer->to($this->alert_email);
            }

            return $this->mailer->pass(['alert_message' => $message, 'alert_level' => $alert_level])->send();
        }

        return true;
    }

    /**
     * Send Alert Text
     *
     * @param $message
     * @param null $subject
     * @return bool
     */
    protected function textAlert($message, $subject = null)
    {
        // Check if text alert enabled
        if ($this->text_enabled) {
          return $this->sms_handler->send($this->alert_phone, $this->alert_provider, $message, $subject);
        }

        return true;
    }


}