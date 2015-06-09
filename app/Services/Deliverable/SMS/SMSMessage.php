<?php

namespace App\Services\Deliverable\SMS;

use Larablocks\EmailSMS\EmailSMSInterface;

class SMSMessage implements EmailSMSInterface
{
    /**
     * Returns the domain of the phone service provider of the message receiver
     * @return string
     */
    public function getPhoneProvider()
    {
        return 'vtext.com';
    }

    /**
     * Returns the ten digit phone number of the message receiver
     * @return integer
     */
    public function getPhoneNumber()
    {
        return '9046109373';
    }

    /**
     * Returns the subject of the message. To skip the subject, return null.
     * @return mixed
     */
    public function getSubject()
    {
        return;
    }

    /**
     * Returns the body of the message
     * @return string
     */
    public function getBody()
    {
        return 'Chilis kids meal code - 250 805 9611';
    }

    /**
     * Returns the email address of the sender
     * @return string
     */
    public function getSenderEmail()
    {
        return 'eric@larablocks.com';
    }

    /**
     * Returns the name of the sender
     * @return string
     */
    public function getSenderName()
    {
        return 'Eric';
    }
}