<?php

namespace App\Services\Support\Alert\Type;

use App\Services\Support\Alert\AlertAbstract;
use Larablocks\Pigeon\PigeonInterface;

/**
 * Class WebopsAlert
 * @package App\Services\Support\Alert\Type
 */
class WebopsAlert extends AlertAbstract
{

    /**
     * Webops Alert Constructor
     *
     * @param PigeonInterface $mailer
     */
    public function __construct(PigeonInterface $mailer)
    {
        // Set properties
        $this->alert_email = config('support.alert.type.webops.email');
        $this->alert_level = config('support.alert.type.webops.level');
        $this->subject_header = config('support.alert.type.webops.subject.header');

        parent::__construct($mailer);
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
    public function alert($message, $subject = null, $alert_level = null, $contacts = null)
    {
        return parent::emailAlert($message, $this->subject_header .' '. $this->alert_level . ': ' . $subject, $alert_level, $contacts);
    }

}