<?php

return [

    /*
     * Choose the Mailer Library for LaraMailer.
     *
     * Current Options: ['SwiftMailer']
     *
     */
    'library' => 'SwiftMailer',


    'message_defaults' => [
        'layout' => 'emails.layouts.default',
        'template' => 'emails.templates.default',
        'subject' => 'LaraMailer Subject'
    ],

    /*
     * Set default configs for specific message types.
     *
     * ---Option types---
     * layout - view file path,
     * template - view file path',
     * subject - string',
     * to - single or array of email address
     * cc - single or array of email address
     * bcc - single or array of email address
     *
     * Ex.
     *    'user_welcome' => [
     *      'layout' => 'emails.layouts.customer',
     *      'template' => 'emails.templates.customer.welcome',
     *      'subject' => 'Welcome New Customer'
     *      'cc' => ['john.doe@myapp.com', 'jane.doe@myapp.com']
     *      'bcc' => 'customerservice@myapp.com'
     *    ]
     *
     */
    'message_types' => [
        'alert' => [
            'layout' => 'emails.layouts.alert',
            'template' => 'emails.templates.alert.standard'
        ],
        'customer_welcome' => [
            'template' => 'emails.templates.customer.welcome',
            'subject' => 'Welcome New Customer!'
        ]
    ]
];

