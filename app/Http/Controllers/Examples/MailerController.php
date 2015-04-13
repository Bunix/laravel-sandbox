<?php namespace App\Http\Controllers\Examples;

use Illuminate\Routing\Controller;

use App\Services\Support\Mailer\Customer\CustomerWelcomeEmail;

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

    public function getIndex(CustomerWelcomeEmail $welcome_email)
    {
        $message_data['first_name'] = 'John';
        $message_data['last_name'] = 'Doe';

        $welcome_email->setTemplate('emails.templates.customer.welcome')
                ->subject('Welcome New Customer')
               //->cc('test1@test.com')
               //->bcc('test2@test.com')
               //->attach('/public/pdf/pdf-test.pdf')
               ->send('emitz13@gmail.com', $message_data);

        echo 'Mail Sent';
    }

}