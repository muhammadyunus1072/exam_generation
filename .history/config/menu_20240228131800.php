<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => env('APP_NAME', 'Template Project'),
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>E-Billing</b>',
    'logo_img' => 'logo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3 bg-white',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-white',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => '',
    'password_reset_url' => '',
    'password_email_url' => '',
    'profile_url' => 'profile',

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

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

        // TAGIHAN PASIEN
        [
            'text' => 'Tagihan Pasien',
            'icon' => 'fas fa-fw fa-cash-register',
            'submenu' => [
                [
                    'text' => 'Layanan Ruangan',
                    'url'  => 'layanan_ruangan',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Verifikasi',
                    'url' => 'verifikasi_billing',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Rekap Tagihan',
                    'url' => 'tagihan_pasien',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Pembayaran Pasien',
                    'url' => 'pembayaran_pasien',
                    'icon_color' => 'success',
                ],
                // [
                //     'text' => 'Rekap Tagihan Pasien',
                //     'url' => 'laporan_hasil_tagihan_pasien',
                //     'icon_color' => 'warning',
                // ],
                [
                    'text' => 'Tarif Mitra',
                    'url' => 'tarif_tindakan_kontraktor',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Ruang Lingkup Tindakan',
                    'url' => 'peta_jenis_tindakan_ke_jenis_no_register',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Tagihan Belum Verifikasi',
                    'url' => 'laporan_tagihan_belum_verifikasi',
                    'icon_color' => 'primary',
                ]
            ],
        ],

        // E-KLAIM
        [
            'text' => 'E-Klaim',
            'icon' => 'fas fa-fw fa-hand-holding-medical',
            'submenu' => [
                [
                    'text' => 'Coding',
                    'url' => 'coding',
                    'icon_color' => 'success',
                    'id' => 'menu_coding',
                ],
                [
                    'text' => 'Verifikasi',
                    'url' => 'verifikasi_coding',
                    'icon_color' => 'success',
                    'id' => 'menu_verifikasi_coding',
                ],
                [
                    'text' => 'Tidak Lulus Verifikasi',
                    'url' => 'verifikasi_failed',
                    'icon_color' => 'success',
                    'id' => 'menu_verifikasi_failed',
                ],
                [
                    'text' => 'Pengajuan',
                    'url' => 'verifikasi_pengajuan',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Pengajuan - Lampiran',
                    'url' => 'laporan_merge_lampiran_tindakan',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Realisasi - Layak',
                    'url' => 'realisasi_layak',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Realisasi - Pending',
                    'url' => 'realisasi_pending',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Realisasi - Tidak Layak',
                    'url' => 'realisasi_tidak_layak',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Realisasi - Dispute',
                    'url' => 'realisasi_dispute',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Pembayaran',
                    'url' => 'realisasi_transaksi_pembayaran',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Koreksi',
                    'url' => 'realisasi_transaksi_koreksi',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Perbandingan Coding',
                    'url' => 'perbandingan_coding',
                    'icon_color' => 'warning',
                ],
                [
                    'text' => 'Rekap Piutang',
                    'url' => 'rekap_realisasi',
                    'icon_color' => 'warning',
                ],
                [
                    'text' => 'Peta Tarif Tindakan',
                    'url' => 'peta_tarif_tindakan',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Peta Tarif Obat',
                    'url' => 'peta_tarif_obat',
                    'icon_color' => 'primary',
                ],
            ],
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

        // PIUTANG PERUSAHAAN
        [
            'text' => 'Piutang Perusahaan',
            'icon' => 'fas fa-fw fa-landmark',
            'submenu' => [
                [
                    'text' => 'Surat Tagihan',
                    'url' => 'surat_tagihan_company',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Input Piutang',
                    'url' => 'input_company_receivable',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Piutang',
                    'url' => 'company_receivable',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Pembayaran',
                    'url' => 'company_receivable_payment',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Koreksi',
                    'url' => 'correction_company',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Rekap Surat Tagihan',
                    'url' => 'rekap_surat_tagihan_perusahaan',
                    'icon_color' => 'warning',
                ],
                [
                    'text' => 'Rekap Pembayaran',
                    'url' => 'rekap_pembayaran_piutang_perusahaan',
                    'icon_color' => 'warning',
                ],
                [
                    'text' => 'Rekap Piutang',
                    'url' => 'rekap_piutang_perusahaan',
                    'icon_color' => 'warning',
                ],
                [
                    'text' => 'Rekap Pembayaran Perorang',
                    'url' => 'rekap_pembayaran_piutang_perusahaan_perorang',
                    'icon_color' => 'warning',
                ],
                [
                    'text' => 'Rekap Piutang Perorang',
                    'url' => 'rekap_piutang_perusahaan_perorang',
                    'icon_color' => 'warning',
                ],
                [
                    'text' => 'Rekapitulasi Piutang',
                    'url' => 'laporan_rekapitulasi_piutang_perusahaan',
                    'icon_color' => 'primary',
                ]
            ],
        ],

        // PIUTANG PERORANGAN
        [
            'text' => 'Piutang Perorangan',
            'icon' => 'fas fa-fw fa-landmark',
            'submenu' => [
                [
                    'text' => 'Surat Tagihan',
                    'url' => 'surat_tagihan',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Piutang',
                    'url' => 'personal_receivable',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Pembayaran',
                    'url' => 'personal_receivable_payment',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Koreksi',
                    'url' => 'correction_personal',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Rekap Pembayaran',
                    'url' => 'rekap_pembayaran_piutang_perorangan',
                    'icon_color' => 'warning',
                ],
                [
                    'text' => 'Rekap Piutang',
                    'url' => 'rekap_piutang_perorangan',
                    'icon_color' => 'warning',
                ],
                [
                    'text' => 'Lampiran Surat Tagihan',
                    'url' => 'lampiran_surat_tagihan',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Rekapitulasi Piutang',
                    'url' => 'laporan_rekapitulasi_piutang_perorangan',
                    'icon_color' => 'primary',
                ]
            ],
        ],

        // PIUTANG LANJUTAN
        [
            'text' => 'Piutang Lanjutan',
            'icon' => 'fas fa-fw fa-landmark',
            'submenu' => [
                [
                    'text' => 'Surat KPKNL',
                    'url' => 'surat_kpknl',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Surat PSBDT',
                    'url' => 'surat_psbdt',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Surat PPNTO',
                    'url' => 'surat_ppnto',
                    'icon_color' => 'success',
                ],

                [
                    'text' => 'Laporan KPKNL',
                    'url' => 'laporan_kpknl',
                    'icon_color' => 'warning',
                ],
                [
                    'text' => 'Laporan PSBDT',
                    'url' => 'laporan_psbdt',
                    'icon_color' => 'warning',
                ],
                [
                    'text' => 'Laporan PPNTO',
                    'url' => 'laporan_ppnto',
                    'icon_color' => 'warning',
                ],
            ],
        ],

        // NON FUNGSIONAL
        [
            'text' => 'Non Fungsional',
            'icon' => 'fas fa-fw fa-hospital-user',
            'submenu' => [
                [
                    'text' => 'Transaksi',
                    'url' => 'non_fungsional_transaksi',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Koreksi',
                    'url' => 'non_fungsional_koreksi',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Rekap Transaksi',
                    'url' => 'rekap_non_fungsional_transaksi',
                    'icon_color' => 'warning',
                ],
                [
                    'text' => 'Rekap Per Bulan',
                    'url' => 'rekap_non_fungsional_per_bulan',
                    'icon_color' => 'warning',
                ],
                [
                    'text' => 'Rekap Bulanan',
                    'url' => 'rekap_non_fungsional_bulanan',
                    'icon_color' => 'warning',
                ],
                [
                    'text' => 'Tarif Non Fungsional',
                    'url' => 'non_fungsional',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Akun Non Fungsional',
                    'url' => 'akun_kas',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Rekapitulasi Piutang',
                    'url' => 'laporan_rekapitulasi_piutang',
                    'icon_color' => 'primary',
                ]
            ],
        ],

        // COUNTING UNIT
        [
            'text' => 'Alat / Unit',
            'icon' => 'fas fa-fw fa-medkit',
            'submenu' => [
                [
                    'text' => 'Master Unit',
                    'url' => 'unit',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Pemetaan',
                    'url' => 'peta_jenis_tindakan_unit',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Laporan',
                    'url' => 'laporan_peta_jenis_tindakan_unit',
                    'icon_color' => 'warning',
                ],
            ]
        ],

        // CLINICAL PATHWAY
        [
            'text' => 'Clinical Pathway',
            'icon' => 'fas fa-fw fa-heartbeat',
            'submenu' => [
                [
                    'text' => 'Pemetaan',
                    'url' => 'clinical_pathway',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Laporan',
                    'url' => 'laporan_clinical_pathway',
                    'icon_color' => 'warning',
                ],
            ]
        ],

        // SETTING
        [
            'text' => 'Pengaturan',
            'icon' => 'fas fa-fw fa-cog',
            'submenu' => [
                [
                    'text' => 'Metode Pembayaran',
                    'url' => 'metode_pembayaran',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Pengguna',
                    'url' => 'user',
                    'icon_color' => 'primary',
                ],
                // [
                //     'text' => 'Jenis Tindakan - Obat',
                //     'url' => 'peta_jenis_tindakan_obat',
                //     'icon_color' => 'primary',
                // ],
            ],
        ],

        // SIMRS
        [
            'text' => 'SIMRS',
            'icon' => 'fas fa-fw fa-server',
            'submenu' => [
                [
                    'text' => 'Ruangan',
                    'url' => 'simrs_ruang',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Mitra',
                    'url' => 'simrs_kontraktor',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Operator',
                    'url' => 'simrs_operator',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Jenis Tindakan',
                    'url' => 'simrs_jenis_tindakan',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Tarif Tindakan',
                    'url' => 'simrs_tarif_tindakan',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Master Obat',
                    'url' => 'simrs_master_obat',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Diagnosa',
                    'url' => 'simrs_diagnosa',
                    'icon_color' => 'primary',
                ],
            ],
        ],
        // [
        //     'text' => 'Jenis Tindakan - Obat',
        //     'url' => 'laporan_peta_jenis_tindakan_obat',
        //     'icon_color' => 'warning',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        // JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        App\Helpers\MenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '/vendor/sweetalert2/sweetalert2.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/sweetalert2/sweetalert2.min.js',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'imask' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/imask/imask.min.js',
                ],
            ],
        ],
        'bs-custom-file-input' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/assets/js/bs-custom-file-input.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => true,
];
