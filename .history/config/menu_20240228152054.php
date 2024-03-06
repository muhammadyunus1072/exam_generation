<?php

return [

    'title' => env('APP_NAME', 'Template Project'),

    'menu' => [
        [
            'text' => 'Dashboard',
            'url'  => 'dashboard',
            'icon' => 'fas fa-fw fa-file',
        ],
        [
            'text' => 'User',
            'icon' => '<i class="ki-duotone ki-
            shield-tick                        ">
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
                    'text' => 'Role And Permission',
                    'url' => 'roles_and_permissions',
                    'icon_color' => 'primary',
                ],
            ],
        ],
    ],
];
