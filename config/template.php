<?php

return [
    'title' => env('APP_NAME', 'Template Project'),
    'subtitle' => 'Software House',

    'logo_auth' => 'files/images/logo.png',
    'logo_auth_background' => 'white',

    'logo_panel' => 'files/images/logo_long.png',
    'logo_panel_background' => 'white',

    'registration_feature' => true,
    'registration_default_role' => 'Member',

    'forgot_password_feature' => true,

    'email_verification_feature' => false,
    'email_verification_delay_time' => 30,

    'menu' => [
        [
            'text' => 'Dashboard',
            'route'  => 'dashboard.index',
            'icon' => 'ki-duotone ki-element-11',
        ],
        [
            'text' => 'Admin',
            'icon' => 'ki-duotone ki-shield-tick',
            'submenu' => [
                [
                    'text' => 'User',
                    'route' => 'user.index',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Role',
                    'route' => 'role.index',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Permission',
                    'route' => 'permission.index',
                    'icon_color' => 'primary',
                ],
            ],
        ],
    ],
];
