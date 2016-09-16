<?php

namespace App\Http\Controllers\Examples;

use Illuminate\Routing\Controller;
use Larablocks\Pigeon\Pigeon;
use Larablocks\Pigeon\PigeonInterface;

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

    public function index(PigeonInterface $mailer)
    {
        er('Start Mailer');

        $mailer->to('test@gmail.com')->send('Test Message');

        er('Mail Sent');
    }

}