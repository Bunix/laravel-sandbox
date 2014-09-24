<?php
namespace App\Services\Mailer\Customer;

use App\Services\Mailer\SwiftMailerAbstract;

/**
 * Class CustomerWelcomeEmail
 * @package App\Services\Mailer\Customer
 *
 * Customer Welcome Email
 *
 */
class CustomerWelcomeEmail extends SwiftMailerAbstract
{
    protected $_template = 'emails.customer.welcome';

    protected $_subject = 'Welcome New Customer';

}