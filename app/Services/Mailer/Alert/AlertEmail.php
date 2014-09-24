<?php
namespace App\Services\Mailer\Alert;

use App\Services\Mailer\SwiftMailerAbstract;


/**
 * Class AlertEmail
 * @package App\Services\Mailer\Alert
 */
class AlertEmail extends SwiftMailerAbstract
{
    protected $_layout = 'emails.layouts.alert';

    protected $_template = 'emails.alert.standard';
}