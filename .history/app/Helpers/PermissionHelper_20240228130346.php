<?php

namespace App\Helpers;

use Illuminate\Http\Request;

/*
| Last Update : 2022/12/12
| Update: getAccessFromRequest should not str_contains to all name
|         ex: access 'user_other' will be readed as access 'user'
 */

class PermissionHelper
{
    // ------LIST PERMISSION TYPE------
    public const PERMISSION_TYPE_CREATE = 'create';
    public const PERMISSION_TYPE_READ = 'read';
    public const PERMISSION_TYPE_UPDATE = 'update';
    public const PERMISSION_TYPE_DELETE = 'delete';
    public const PERMISSION_TYPE_ALL = [self::PERMISSION_TYPE_CREATE, self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE, self::PERMISSION_TYPE_DELETE];
    public const PERMISSION_TYPE_ALL_EXCEPT_DELETE = [self::PERMISSION_TYPE_CREATE, self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE];

    // ---- ROUTE NAME ----
    public const ROUTE_NAME_CREATE = ['create', 'store'];
    public const ROUTE_NAME_READ = ['index', 'show', 'edit', 'print', 'get', 'find', 'export'];
    public const ROUTE_NAME_UPDATE = ['edit', 'update', 'approve'];
    public const ROUTE_NAME_DELETE = ['destroy'];
    public const ROUTE_NAME_HISTORY = ['history'];

    // ---- LIST ACCESS ----
    // OPERASIONAL
    public const ACCESS_DASHBOARD = "dashboard";

    public const ALL_ACCESSIBLE = [
        // OPERASIONAL
        self::ACCESS_NON_FUNGSIONAL_TRANSAKSI => 'Transaksi Non Fungsional',
        self::ACCESS_NON_FUNGSIONAL_KOREKSI => 'Koreksi Non Fungsional',
        self::ACCESS_NON_FUNGSIONAL_TRANSAKSI_STATUS => 'Transaksi Non Fungsional Status',
        self::ACCESS_NON_FUNGSIONAL_TRANSAKSI_PEMBAYARAN => 'Transaksi Pembayaran Non Fungsional',
        self::ACCESS_LAMPIRAN_TINDAKAN => 'Lampiran Tindakan',
        self::ACCESS_LAYANAN_RUANGAN => 'Layanan Ruangan',

        // VERIFIKATOR
        self::ACCESS_VERIFIKASI_BILLING => "Verifikasi Billing",
        self::ACCESS_VERIFIKASI_CODING => "Verifikasi Coding",
        self::ACCESS_VERIFIKASI_FAILED => "Tidak Lulus Verifikasi",
        self::ACCESS_VERIFIKASI_PENGAJUAN => "Verifikasi Pengajuan",

        // KASIR
        self::ACCESS_PEMBAYARAN_PASIEN => "Pembayaran Pasien",
        self::ACCESS_TAGIHAN_PASIEN => "Tagihan Pasien",

        // E-KLAIM
        self::ACCESS_CODING => "Coding",
        self::ACCESS_REALISASI_LAYAK => "Realisasi Layak",
        self::ACCESS_REALISASI_PENDING => "Realisasi Pending",
        self::ACCESS_REALISASI_TIDAK_LAYAK => "Realisasi Tidak Layak",
        self::ACCESS_REALISASI_DISPUTE => "Realisasi Dispute",
        self::ACCESS_REALISASI_TRANSAKSI_PEMBAYARAN => "Realisasi Transaksi Pembayaran",
        self::ACCESS_REALISASI_TRANSAKSI_KOREKSI => "Realisasi Transaksi Koreksi",

        // PIUTANG JKN
        self::ACCESS_PIUTANG_JKN_PEMBAYARAN => "Piutang JKN - Pembayaran",
        self::ACCESS_PIUTANG_JKN_KOREKSI => "Piutang JKN - Koreksi",
        
        // PIUTANG
        self::ACCESS_COMPANY_RECEIVABLE => "Piutang Perusahaan",
        self::ACCESS_INPUT_COMPANY_RECEIVABLE => "Input Piutang Perusahaan",
        self::ACCESS_COMPANY_RECEIVABLE_PAYMENT => "Pembayaran Piutang Perusahaan",
        self::ACCESS_CORRECTION_COMPANY => "Koreksi Piutang Perusahaan",
        self::ACCESS_PERSONAL_RECEIVABLE => "Piutang Perorangan",
        self::ACCESS_PERSONAL_RECEIVABLE_PAYMENT => "Pembayaran Piutang Perorangan",
        self::ACCESS_CORRECTION_PERSONAL => "Koreksi Piutang Perorangan",
        self::ACCESS_SURAT_TAGIHAN_COMPANY => "Surat Tagihan Perusahaan",
        self::ACCESS_SURAT_TAGIHAN => "Surat Tagihan",
        self::ACCESS_SURAT_PERNYATAAN_PIUTANG => "Surat Pernyataan Piutang",
        
        // PIUTANG LANJUTAN
        self::ACCESS_SURAT_KPKNL => "Surat KPKNL",
        self::ACCESS_SURAT_PSBDT => "Surat PSBDT",
        self::ACCESS_SURAT_PPNTO => "Surat PPNTO",
        
        // LAPORAN
        self::ACCESS_LAPORAN_REKAPITULASI_PIUTANG => "Laporan Rekapitulasi Piutang",
        self::ACCESS_LAPORAN_TAGIHAN_BELUM_VERIFIKASI => "Laporan Tagihan Belum Verifikasi",
        self::ACCESS_LAPORAN_REKAPITULASI_PIUTANG_PERUSAHAAN => "Laporan Rekapitulasi Piutang Perusahaan",
        self::ACCESS_LAPORAN_REKAPITULASI_PIUTANG_PERORANGAN => "Laporan Rekapitulasi Piutang Perorangan",
        self::ACCESS_REKAP_PIUTANG_PERORANGAN => 'Laporan - Piutang Perorangan',
        self::ACCESS_REKAP_PEMBAYARAN_PIUTANG_PERORANGAN => 'Laporan - Pembayaran Piutang Perorangan',
        self::ACCESS_REKAP_PIUTANG_PERUSAHAAN => 'Laporan - Piutang Perusahaan',
        self::ACCESS_REKAP_PIUTANG_PERUSAHAAN_PERORANG => 'Laporan - Piutang Perusahaan Perorang',
        self::ACCESS_REKAP_SURAT_TAGIHAN_PERUSAHAAN => 'Laporan - Surat Tagihan Perusahaan',
        self::ACCESS_REKAP_PEMBAYARAN_PIUTANG_PERUSAHAAN => 'Laporan - Pembayaran Piutang Perusahaan',
        self::ACCESS_REKAP_PEMBAYARAN_PIUTANG_PERUSAHAAN_PERORANG => 'Laporan - Pembayaran Piutang Perusahaan Perorang',
        self::ACCESS_REKAP_NON_FUNGSIONAL_TRANSAKSI => 'Laporan - Non Fungsional Transaksi',
        self::ACCESS_REKAP_NON_FUNGSIONAL_PER_BULAN => 'Laporan - Non Fungsional Per Bulan',
        self::ACCESS_REKAP_NON_FUNGSIONAL_BULANAN => 'Laporan - Non Fungsional Bulanan',
        self::ACCESS_PERBANDINGAN_CODING => "Laporan - Perbandingan Coding",
        self::ACCESS_REKAP_REALISASI => "Laporan - Rekap Realisasi",
        self::ACCESS_LAPORAN_HASIL_TAGIHAN_PASIEN => 'Laporan Hasil Tagihan Pasien',
        self::ACCESS_LAPORAN_PETA_TARIF_TINDAKAN_UNIT => 'Laporan Peta Tarif Tindakan - Unit',
        self::ACCESS_LAPORAN_PETA_TARIF_TINDAKAN_OBAT => 'Laporan Peta Tarif Tindakan - Obat',
        self::ACCESS_LAPORAN_CLINICAL_PATHWAY => 'Laporan Clinical Pathway',
        self::ACCESS_LAPORAN_KPKNL => 'Laporan KPKNL',
        self::ACCESS_LAPORAN_PSBDT => 'Laporan PSBDT',
        self::ACCESS_LAPORAN_PPNTO => 'Laporan PPNTO',
        self::ACCESS_LAPORAN_MERGE_LAMPIRAN_TINDAKAN => 'Laporan Proses Penggabungan Lampiran Tindakan',

        // MASTER DATA
        self::ACCESS_CLINICAL_PATHWAY => 'Data Clinical Pathway',
        self::ACCESS_USER => 'Data Pengguna',
        self::ACCESS_PETUGAS_PIUTANG => 'Data Petugas Piutang',
        self::ACCESS_AKUN_KAS => 'Data Akun Kas',
        self::ACCESS_TARIF_TINDAKAN_KONTRAKTOR => 'Tarif Perusahaan',
        self::ACCESS_NON_FUNGSIONAL => 'Data Tarif Non Fungsional',
        self::ACCESS_MASTER_TARIF_TINDAKAN => 'Data Master Tarif Tindakan',
        self::ACCESS_MASTER_JENIS_TINDAKAN => 'Data Master Jenis Tindakan',
        self::ACCESS_METODE_PEMBAYARAN => 'Data Metode Pembayaran',
        self::ACCESS_LAMPIRAN_SURAT_TAGIHAN => 'Data Lampiran Surat Tagihan',
        self::ACCESS_LAMPIRAN_SURAT_PERNYATAAN_PIUTANG => 'Data Lampiran Surat Pernyataan Piutang',
        self::ACCESS_PETA_TARIF_TINDAKAN => 'Peta Tarif Tindakan',
        self::ACCESS_PETA_TARIF_OBAT => 'Peta Tarif Obat',
        self::ACCESS_UNIT => 'Unit',
        self::ACCESS_PETA_TARIF_TINDAKAN_UNIT => 'Peta Jenis Tindakan - Unit',
        self::ACCESS_PETA_TARIF_TINDAKAN_OBAT => 'Peta Jenis Tindakan - Obat',
        self::ACCESS_PETA_JENIS_TINDAKAN_KE_JENIS_NO_REGISTER => 'Peta Jenis Tindakan - Jenis No Register',

        // SIMRS
        self::ACCESS_SIMRS_RUANG => "SIMRS - Ruang",
        self::ACCESS_SIMRS_OPERATOR => "SIMRS - Operator",
        self::ACCESS_SIMRS_KONTRAKTOR => "SIMRS - Mitra",
        self::ACCESS_SIMRS_JENIS_TINDAKAN => "SIMRS - Jenis Tindakan",
        self::ACCESS_SIMRS_TARIF_TINDAKAN => "SIMRS - Tarif Tindakan",
        self::ACCESS_SIMRS_MASTER_OBAT => "SIMRS - Master Obat",
        self::ACCESS_SIMRS_DIAGNOSA => "SIMRS - Diagnosa",
    ];

    public const ALL_ACCESSIBLE_PERMISSION = [
        // OPERASIONAL
        self::ACCESS_NON_FUNGSIONAL_TRANSAKSI => self::PERMISSION_TYPE_ALL,
        self::ACCESS_NON_FUNGSIONAL_KOREKSI => self::PERMISSION_TYPE_ALL,
        self::ACCESS_NON_FUNGSIONAL_TRANSAKSI_STATUS => [self::PERMISSION_TYPE_UPDATE, self::PERMISSION_TYPE_DELETE],
        self::ACCESS_NON_FUNGSIONAL_TRANSAKSI_PEMBAYARAN => [self::PERMISSION_TYPE_CREATE, self::PERMISSION_TYPE_UPDATE, self::PERMISSION_TYPE_DELETE],
        self::ACCESS_LAMPIRAN_TINDAKAN => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_CREATE, self::PERMISSION_TYPE_DELETE],
        self::ACCESS_LAYANAN_RUANGAN => self::PERMISSION_TYPE_ALL,

        // VERIFIKATOR
        self::ACCESS_VERIFIKASI_BILLING => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_VERIFIKASI_CODING => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_VERIFIKASI_FAILED => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_VERIFIKASI_PENGAJUAN => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],

        // PIUTANG
        self::ACCESS_PEMBAYARAN_PASIEN => self::PERMISSION_TYPE_ALL,
        self::ACCESS_TAGIHAN_PASIEN => self::PERMISSION_TYPE_ALL,

        // E-KLAIM
        self::ACCESS_CODING => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_REALISASI_LAYAK => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_REALISASI_PENDING => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_REALISASI_TIDAK_LAYAK => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_REALISASI_DISPUTE => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_REALISASI_TRANSAKSI_PEMBAYARAN => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_CREATE, self::PERMISSION_TYPE_DELETE],
        self::ACCESS_REALISASI_TRANSAKSI_KOREKSI => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_CREATE, self::PERMISSION_TYPE_DELETE],

        // PIUTANG JKN
        self::ACCESS_PIUTANG_JKN_PEMBAYARAN => self::PERMISSION_TYPE_ALL,
        self::ACCESS_PIUTANG_JKN_KOREKSI => self::PERMISSION_TYPE_ALL,
        
        // PIUTANG
        self::ACCESS_COMPANY_RECEIVABLE => self::PERMISSION_TYPE_ALL,
        self::ACCESS_INPUT_COMPANY_RECEIVABLE => self::PERMISSION_TYPE_ALL,
        self::ACCESS_COMPANY_RECEIVABLE_PAYMENT => self::PERMISSION_TYPE_ALL,
        self::ACCESS_CORRECTION_COMPANY => self::PERMISSION_TYPE_ALL,
        self::ACCESS_PERSONAL_RECEIVABLE => self::PERMISSION_TYPE_ALL,
        self::ACCESS_PERSONAL_RECEIVABLE_PAYMENT => self::PERMISSION_TYPE_ALL,
        self::ACCESS_CORRECTION_PERSONAL => self::PERMISSION_TYPE_ALL,
        self::ACCESS_SURAT_TAGIHAN_COMPANY => self::PERMISSION_TYPE_ALL,
        self::ACCESS_SURAT_TAGIHAN => self::PERMISSION_TYPE_ALL,
        self::ACCESS_SURAT_PERNYATAAN_PIUTANG => self::PERMISSION_TYPE_ALL,
        
        // PIUTANG LANJUTAN
        self::ACCESS_SURAT_KPKNL => self::PERMISSION_TYPE_ALL,
        self::ACCESS_SURAT_PSBDT => self::PERMISSION_TYPE_ALL,
        self::ACCESS_SURAT_PPNTO => self::PERMISSION_TYPE_ALL,
        
        // LAPORAN
        self::ACCESS_LAPORAN_REKAPITULASI_PIUTANG => self::PERMISSION_TYPE_ALL,
        self::ACCESS_LAPORAN_TAGIHAN_BELUM_VERIFIKASI => self::PERMISSION_TYPE_ALL,
        self::ACCESS_LAPORAN_REKAPITULASI_PIUTANG_PERUSAHAAN => self::PERMISSION_TYPE_ALL,
        self::ACCESS_LAPORAN_REKAPITULASI_PIUTANG_PERORANGAN => self::PERMISSION_TYPE_ALL,
        self::ACCESS_REKAP_PIUTANG_PERORANGAN => [self::PERMISSION_TYPE_READ],
        self::ACCESS_REKAP_PEMBAYARAN_PIUTANG_PERORANGAN => [self::PERMISSION_TYPE_READ],
        self::ACCESS_REKAP_SURAT_TAGIHAN_PERUSAHAAN => [self::PERMISSION_TYPE_READ],
        self::ACCESS_REKAP_PIUTANG_PERUSAHAAN => [self::PERMISSION_TYPE_READ],
        self::ACCESS_REKAP_PIUTANG_PERUSAHAAN_PERORANG => [self::PERMISSION_TYPE_READ],
        self::ACCESS_REKAP_PEMBAYARAN_PIUTANG_PERUSAHAAN => [self::PERMISSION_TYPE_READ],
        self::ACCESS_REKAP_PEMBAYARAN_PIUTANG_PERUSAHAAN_PERORANG => [self::PERMISSION_TYPE_READ],
        self::ACCESS_REKAP_NON_FUNGSIONAL_TRANSAKSI => [self::PERMISSION_TYPE_READ],
        self::ACCESS_REKAP_NON_FUNGSIONAL_PER_BULAN => [self::PERMISSION_TYPE_READ],
        self::ACCESS_REKAP_NON_FUNGSIONAL_BULANAN => [self::PERMISSION_TYPE_READ],
        self::ACCESS_PERBANDINGAN_CODING => [self::PERMISSION_TYPE_READ],
        self::ACCESS_REKAP_REALISASI => [self::PERMISSION_TYPE_READ],
        self::ACCESS_LAPORAN_HASIL_TAGIHAN_PASIEN => [self::PERMISSION_TYPE_READ],
        self::ACCESS_LAPORAN_PETA_TARIF_TINDAKAN_OBAT => [self::PERMISSION_TYPE_READ],
        self::ACCESS_LAPORAN_PETA_TARIF_TINDAKAN_UNIT => [self::PERMISSION_TYPE_READ],
        self::ACCESS_LAPORAN_CLINICAL_PATHWAY => [self::PERMISSION_TYPE_READ],
        self::ACCESS_LAPORAN_KPKNL => [self::PERMISSION_TYPE_READ],
        self::ACCESS_LAPORAN_PSBDT => [self::PERMISSION_TYPE_READ],
        self::ACCESS_LAPORAN_PPNTO => [self::PERMISSION_TYPE_READ],
        self::ACCESS_LAPORAN_MERGE_LAMPIRAN_TINDAKAN => [self::PERMISSION_TYPE_READ],

        // MASTER DATA
        self::ACCESS_CLINICAL_PATHWAY => self::PERMISSION_TYPE_ALL,
        self::ACCESS_USER => self::PERMISSION_TYPE_ALL,
        self::ACCESS_PETUGAS_PIUTANG => self::PERMISSION_TYPE_ALL,
        self::ACCESS_AKUN_KAS => self::PERMISSION_TYPE_ALL,
        self::ACCESS_TARIF_TINDAKAN_KONTRAKTOR => self::PERMISSION_TYPE_ALL,
        self::ACCESS_NON_FUNGSIONAL => self::PERMISSION_TYPE_ALL,
        self::ACCESS_MASTER_TARIF_TINDAKAN => self::PERMISSION_TYPE_ALL,
        self::ACCESS_MASTER_JENIS_TINDAKAN => self::PERMISSION_TYPE_ALL,
        self::ACCESS_METODE_PEMBAYARAN => self::PERMISSION_TYPE_ALL,
        self::ACCESS_LAMPIRAN_SURAT_TAGIHAN => self::PERMISSION_TYPE_ALL,
        self::ACCESS_LAMPIRAN_SURAT_PERNYATAAN_PIUTANG => self::PERMISSION_TYPE_ALL,
        self::ACCESS_PETA_TARIF_TINDAKAN => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_PETA_TARIF_OBAT => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_UNIT => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_PETA_TARIF_TINDAKAN => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_PETA_TARIF_TINDAKAN_UNIT => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_PETA_TARIF_TINDAKAN_OBAT => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_PETA_JENIS_TINDAKAN_KE_JENIS_NO_REGISTER => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],

        // SIMRS
        self::ACCESS_SIMRS_RUANG => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_SIMRS_KONTRAKTOR => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_SIMRS_OPERATOR => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_SIMRS_JENIS_TINDAKAN => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_SIMRS_TARIF_TINDAKAN => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_SIMRS_MASTER_OBAT => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
        self::ACCESS_SIMRS_DIAGNOSA => [self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE],
    ];

    public static function generatePermissionAll()
    {
        $permissionAll = [];
        foreach (self::ALL_ACCESSIBLE as $access => $name) {
            $permissionAll[$access] = self::PERMISSION_TYPE_ALL;
        }
        $permissionAll = json_encode($permissionAll);

        return $permissionAll;
    }

    public static function generatePermission($arrayPermission)
    {
        $permissions = [];
        foreach ($arrayPermission as $access => $type) {
            $permissionAll[$access] = $type;
        }
        $permissions = json_encode($permissions);

        return $permissions;
    }

    public static function isPermitted($user, $permissionType, $access)
    {
        $jsonPermissions = json_decode($user->permissions);

        if (empty($jsonPermissions->$access)) {
            return false;
        }

        // ---Role Abilites For Spesific Access---
        $permission = $jsonPermissions->$access;

        return !empty($permission) && in_array($permissionType, $permission);
    }

    public static function isRequestPermitted(Request $request)
    {
        $user = $request->user();
        $permissionType = self::getPermissionTypeFromRequest($request);
        $access = self::getAccessFromRequest($request);

        return self::isPermitted($user, $permissionType, $access);
    }

    private static function getAccessFromRequest($request)
    {
        $routeName = explode('.', $request->route()->getName())[0];
        foreach (self::ALL_ACCESSIBLE as $access => $name) {
            if ($routeName == $access) {
                return $access;
            }
        }

        return null;
    }

    private static function getPermissionTypeFromRequest($request)
    {
        $routeName = $request->route()->getName();
        if (self::inArray($routeName, self::ROUTE_NAME_READ)) {
            return self::PERMISSION_TYPE_READ;
        } elseif (self::inArray($routeName, self::ROUTE_NAME_CREATE)) {
            return self::PERMISSION_TYPE_CREATE;
        } elseif (self::inArray($routeName, self::ROUTE_NAME_UPDATE)) {
            return self::PERMISSION_TYPE_UPDATE;
        } elseif (self::inArray($routeName, self::ROUTE_NAME_DELETE)) {
            return self::PERMISSION_TYPE_DELETE;
        }

        return null;
    }

    private static function inArray($needle, $haystack)
    {
        foreach ($haystack as $obj) {
            if (str_contains($needle, $obj)) {
                return true;
            }
        }

        return false;
    }
}
