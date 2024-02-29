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
