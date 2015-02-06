<?php namespace App\Services\Support\Mailer\Customer;

use App\Services\Support\Mailer\SwiftMailerAbstract;

/**
 * Class CustomerWelcomeEmail
 * @package App\Services\Mailer\Customer
 */
class CustomerWelcomeEmail extends SwiftMailerAbstract
{
    protected $template = 'emails.customer.welcome';

    protected $subject = 'Welcome New Customer';

}