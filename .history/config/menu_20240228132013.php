<?php

return [

    'title' => env('APP_NAME', 'Template Project'),

    'menu' => [
        // Navbar items:
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        [
            'text' => 'Lampiran Pasien',
            'url'  => 'lampiran_tindakan',
            'icon' => 'fas fa-fw fa-file',
        ],

        // PERNYATAAN PIUTANG
        [
            'text' => 'Pernyataan Piutang',
            'icon' => 'fas fa-fw fa-file-alt',
            'submenu' => [
                [
                    'text' => 'Surat Pernyataan Piutang',
                    'url' => 'surat_pernyataan_piutang',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Lampiran Surat Pernyataan Piutang',
                    'url' => 'lampiran_surat_pernyataan_piutang',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Petugas Piutang',
                    'url' => 'petugas_piutang',
                    'icon_color' => 'primary',
                ],
            ],
        ],
    ],
];
