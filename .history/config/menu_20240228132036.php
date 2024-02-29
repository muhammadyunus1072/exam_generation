<?php

return [

    'title' => env('APP_NAME', 'Template Project'),

    'menu' => [
        [
            'text' => 'Lampiran Pasien',
            'url'  => 'lampiran_tindakan',
            'icon' => 'fas fa-fw fa-file',
        ],
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
            ],
        ],
    ],
];
