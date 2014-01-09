<?php

use NewProject\Services\Mailer\Customer\CustomerWelcomeEmail;

class MailerController extends BaseController {

    public function index()
    {
        $data['first_name'] = 'John';
        $data['last_name'] = 'Doe';

        $mailer = new CustomerWelcomeEmail('test@test.com', $data);
        $mailer->subject('New Subject')
               ->setTemplate('emails.customer.alert')
               ->cc('test1@test.com')
               ->bcc('test2@test.com')
               ->attach(base_path().'/public/images/pdf-test.pdf');
        $mailer->send();

        echo 'Mail Sent';
    }

}