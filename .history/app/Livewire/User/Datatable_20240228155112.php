<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AkunKas;
use Livewire\Component;
use App\Models\SuratKpknl;
use App\Helpers\ExportHelper;
use App\Traits\WithDatatable;
use App\Helpers\NumberFormatter;
use App\Models\SuratKpknlDetail;
use App\Helpers\PermissionHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Datatable extends Component
{
    use WithDatatable;

    public $end_date;
    public $start_date;

    public $keyword_filter = false;

    protected $listeners = [
        'addFilter',
        'export'
    ];

    public function onMount()
    {
        $this->sortDirection = 'desc';
        $this->end_date = Carbon::now()->format('Y-m-d');
        $this->start_date = Carbon::now()->subMonths(1)->format('Y-m-d');
    }

    public function addFilter($filter)
    {
        foreach ($filter as $key => $value) {
            $this->$key = $value;
        }
    }
    public function export($type)
    {
        $fileName = 'Data Laporan KPKNL ' . Carbon::parse($this->start_date)->format('Y-m-d') . ' sd ' . Carbon::parse($this->end_date)->format('Y-m-d');

        $data = $this->getProcessedQuery()->get();

        return ExportHelper::export(
            $type,
            $fileName,
            $data,
            "app.laporan.laporan_kpknl.export",
            [
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'type' => $type,
                'title' => 'Data Laporan KPKNL',
            ],
            [
                'size' => 'legal',
                'orientation' => 'portrait',
            ]
        );
    }

    public function getColumns(): array
    {
        return [
            [
                'sortable' => false,
                'searchable' => false,
                'name' => 'Tanggal Piutang',
                'render' => function ($item) {
                    return $item->piutang_tanggal_piutang;
                }
            ],
            [
                'sortable' => false,
                'searchable' => false,
                'name' => 'Nomor',
                'render' => function ($item) {
                    return $item->surat_kpknl->nomor;
                }
            ],
            [
                'sortable' => false,
                'searchable' => false,
                'name' => 'Nomor Register',
                'render' => function ($item) {
                    return $item->piutang_pasien_no_register;
                }
            ],
            [
                'sortable' => false,
                'searchable' => false,
                'name' => 'Nama Pasien',
                'render' => function ($item) {
                    return $item->piutang_pasien_nama;
                }
            ],
            [
                'sortable' => false,
                'searchable' => false,
                'name' => 'Alamat',
                'render' => function ($item) {
                    return $item->piutang_pasien_alamat;
                }
            ],
            [
                'sortable' => false,
                'searchable' => false,
                'name' => 'Nilai Piutang',
                'render' => function ($item) {
                    return NumberFormatter::format($item->piutang_nilai_awal);
                }
            ],
            [
                'sortable' => false,
                'searchable' => false,
                'name' => 'Nama Penjamin',
                'render' => function ($item) {
                    return $item->piutang_pasien_penanggung_jawab;
                }
            ],
            [
                'sortable' => false,
                'searchable' => false,
                'name' => 'Alamat Penjamin (Sesuai KTP)',
                'render' => function ($item) {
                    return $item->piutang_pasien_penanggung_jawab_alamat_ktp;
                }
            ],
        ];
    }

    public function getQuery(): Builder
    {
        $start_date = $this->start_date . " 00:00:00";
        $end_date = $this->end_date . " 23:59:59";

        return User::query();
    }

    public function getView(): string
    {
        return 'livewire.user.datatable';
    }
}
