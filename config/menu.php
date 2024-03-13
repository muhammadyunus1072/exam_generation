<?php

return [

    'title' => env('APP_NAME', 'Template Project'),

    'menu' => [
        [
            'text' => 'Dashboard',
            'url'  => 'dashboard',
            'icon' => '<i class="ki-duotone ki-element-11 fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
        </i>',
        ],
        [
            'text' => 'Admin',
            'icon' => '<i class="ki-duotone ki-shield-tick fs-1">
                <span class="path1"></span>
                <span class="path2"></span>
                </i>',
            'submenu' => [
                [
                    'text' => 'User',
                    'url' => 'users',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Role',
                    'url' => 'roles',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Permissions',
                    'url' => 'permissions',
                    'icon_color' => 'primary',
                ],
            ],
        ],
        [
            'text' => 'Documentation',
            'url'  => 'documentation',
            'icon' => '<i class="ki-duotone ki-element-11 fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
        </i>',
        ],
    ],
];
