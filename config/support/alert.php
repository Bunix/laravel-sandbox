<?php

/*
 * Alert Service Settings
 *
 */

return [
    'enabled' => [
        'email' => env('ALERT_ENABLED_EMAIL'),
        'text' => env('ALERT_ENABLED_TEXT'),
    ],
    'type' => [
        'webops' => [
            'email' => env('ALERT_TYPE_WEBOPS_EMAIL'),
            'level' => 'Critical',
            'subject' => [
                'header' => '(MyApp) '
            ]
        ]
    ]
];

