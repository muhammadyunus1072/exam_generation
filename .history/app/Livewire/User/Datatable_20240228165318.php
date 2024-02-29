<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Traits\WithDatatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Datatable extends Component
{
    use WithDatatable;

    public $end_date;
    public $start_date;

    protected $listeners = [
        'addFilter',
    ];

    public function sortById($name)
    {
        $this->sortBy($name);
    }
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
                'key' => 'id',
                'name' => 'Data',
                'render' => function ($item) {
                    return $item->id;
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
