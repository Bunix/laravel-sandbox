<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

use App\Services\Support\Mailer\Customer\CustomerWelcomeEmail;

class MailerController extends Controller
{

    public function index()
    {
        $data['first_name'] = 'John';
        $data['last_name'] = 'Doe';

        $mailer = new CustomerWelcomeEmail('emitz13@gmail.com', $data);
               $mailer->subject('New Subject')
               ->setTemplate('emails.customer.alert')
               ->cc('test1@test.com')
               ->bcc('test2@test.com')
               ->attach('/public/images/pdf-test.pdf')
               ->send();


        echo 'Mail Sent';

    }

}