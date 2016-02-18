<?php

/*
 * Alert Service Settings
 *
 */

return [
    'enabled' => [
        'email' => env('ALERT_ENABLED_EMAIL', true),
        'text' => env('ALERT_ENABLED_TEXT', false),
    ],
    'type' => [
        'webops' => [
            'recipients' => [
                'email' => env('ALERT_TYPE_WEBOPS_RECIPIENTS_EMAIL'),
                'phone' => env('ALERT_TYPE_WEBOPS_RECIPIENTS_PHONE'),
                'provider' => env('ALERT_TYPE_WEBOPS_RECIPIENTS_PROVIDER'),
            ],
            'level' => 'Critical',
            'subject' => [
                'header' => env('ALERT_TYPE_WEBOPS_SUBJECT_HEADER', '(MyApp)')
            ]
        ]
    ]
];

