<?php namespace App\Services\Support\Mailer\Customer;

use App\Services\Support\Mailer\SwiftMailerAbstract;

/**
 * Class CustomerWelcomeEmail
 * @package RightStart\Services\Mailer\Customer
 *
 * Customer Welcome Email
 *
 */
class CustomerWelcomeEmail extends SwiftMailerAbstract
{
    protected $template = 'emails.customer.welcome';

    protected $subject = 'Welcome New Customer';

}