<?php namespace App\Http\Controllers\Examples;


use Illuminate\Routing\Controller;
use LaraMailer\LaraMailerInterface;

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

    public function getIndex(LaraMailerInterface $mailer)
    {
        er('Start Mailer');

        $message_data['first_name'] = 'John';
        $message_data['last_name'] = 'Doe';

        $result = $mailer->type('customer_welcome')->to('emitz13@gmail.com')->pass($message_data)->send();
               //->bcc(['emitz16@hotmail.com', 'eric.mitkowski@gmail.com'])
               //->attach('/public/pdf/pdf-test.pdf')

        xr($result);

        echo 'Mail Sent';
    }

}