<?php

namespace App\Services\Support\Alert\Type;

use App\Services\Support\Alert\AlertAbstract;
use App\Services\Support\SMS\EmailSMSHandler;
use Larablocks\Pigeon\PigeonInterface;

/**
 * Class WebopsAlert
 *
 * @package App\Services\Support\Alert\Type
 */
class WebopsAlert extends AlertAbstract
{

    /**
     * Webops Alert Constructor
     *
     * @param PigeonInterface $mailer
     * @param EmailSMSHandler $sms_handler
     */
    public function __construct(PigeonInterface $mailer, EmailSMSHandler $sms_handler)
    {
        // Set properties
        $this->alert_email = config('support.alert.type.webops.recipients.email');
        $this->alert_phone = config('support.alert.type.webops.recipients.phone');
        $this->alert_provider = config('support.alert.type.webops.recipients.provider');
        $this->alert_level = config('support.alert.type.webops.level');
        $this->subject_header = config('support.alert.type.webops.subject.header');

        parent::__construct($mailer, $sms_handler);
    }

    /**
     * Call Alert for Subclass
     *
     * Just passes the config email for subclass with the
     * other variables to parent method
     *
     * @param $message
     * @param null $subject
     * @param null $alert_level
     * @param array $contacts
     * @return bool
     */
    public function alert($message, $subject = null, $alert_level = null, $contacts = [])
    {
        if (is_null($alert_level)) {
            $alert_level = $this->alert_level;
        }

        $email_result = parent::emailAlert($message, $this->subject_header . ' ' . $alert_level . ': ' . $subject, $alert_level, $contacts);
        $text_result = parent::textAlert($message, $this->subject_header . ' ' . $alert_level . ': ' . $subject);

        if ($email_result === false || $text_result === false) {
            return false;
        }

        return true;
    }

}