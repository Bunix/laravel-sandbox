<?php

return [

    /*
     * Choose the Mailer Library for LaraMailer.
     *
     * Options: ['SwiftMailer']
     *
     */
    'library' => 'SwiftMailer',

    'message_types' => [
        'alert' => [
            'layout' => 'emails.layouts.alert',
            'template' => 'emails.templates.alert.standard'
        ],
        'new_customer' => [
            'template' => 'emails.templates.customer.welcome',
            'subject' => 'Welcome New Customer!'
        ],
    ]
];

