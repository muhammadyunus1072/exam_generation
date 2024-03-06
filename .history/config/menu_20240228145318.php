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
            'icon' => 'fas fa-fw fa-file-alt',
            'submenu' => [
                [
                    'text' => 'User',
                    'url' => 'user',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Role And Permission',
                    'url' => 'lampiran_surat_pernyataan_piutang',
                    'icon_color' => 'primary',
                ],
            ],
        ],
    ],
];
