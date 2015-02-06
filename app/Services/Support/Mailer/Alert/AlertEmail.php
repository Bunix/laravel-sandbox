<?php namespace App\Services\Support\Mailer\Alert;

use App\Services\Support\Mailer\SwiftMailerAbstract;


class AlertEmail extends SwiftMailerAbstract
{
    protected $layout = 'emails.layouts.alert';

    protected $template = 'emails.alert.standard';
}