<?php

use NewProject\Services\Mailer\Customer\CustomerWelcomeEmail;

class MailerController extends BaseController {

    public function index()
    {
        $data['first_name'] = 'John';
        $data['last_name'] = 'Doe';

        $mailer = new CustomerWelcomeEmail('emitz13@gmail.com', $data);
        $mailer->subject('Override Subject')->bcc('emitz13@gmail.com')->attach(base_path().'/public/images/pdf-test.pdf');
        $mailer->send();

        echo 'Mail Sent';
    }

}