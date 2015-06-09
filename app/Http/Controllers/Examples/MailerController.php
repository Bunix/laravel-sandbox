<?php

namespace App\Http\Controllers\Examples;

use App\Services\Deliverable\SMS\SMSMessage;
use Illuminate\Routing\Controller;
use Larablocks\Pigeon\Pigeon;

class MailerController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getIndex()
    {
        er('Start Mailer');

        Pigeon::type('custom_message_type')->to('emitz13@gmail.com')->send();

        er('Mail Sent');
    }

    public function getSms(EmailSMSHandler $sms)
    {
        er('Start SMS');

        $sms->send(new SMSMessage());

        er('SMS Sent');
    }

}