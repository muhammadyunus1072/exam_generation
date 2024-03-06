<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Traits\WithDatatable;
use App\Helpers\PermissionHelper;
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
                'name' => 'Action',
                'sortable' => false,
                'searchable' => false,
                'render' => function ($item) {

                    $authUser = User::find(Auth::id());

                    $editHtml = "";
                    if ($authUser->isCanUpdate(PermissionHelper::ACCESS_UNIT) && $item->isEditable()) {
                        $editHtml = "<div class='col-auto'><button class='btn btn-primary btn-sm' data-toggle='modal'
                        data-target='#editModal' wire:click=\"\$emit('editDetail','$item->id')\"><i class='fa fa-edit'></i> Edit</button></div>";
                    }

                    $destroyHtml = "";
                    if ($authUser->isCanDelete(PermissionHelper::ACCESS_UNIT) && $item->isDeletable()) {
                        $destroyHtml = "<form wire:submit.prevent=\"destroy('$item->id')\">"
                            . method_field('DELETE') . csrf_field() .
                            "<button type='submit' class='btn btn-danger btn-sm'
                                onclick=\"return confirm('Delete Data?')\">
                                <i class='fa fa-trash mr-2'></i>Hapus
                            </button>
                        </form>";
                    }

                    $html = "<div class='row'>
                        $editHtml $destroyHtml 
                    </div>";

                    return $html;
                },
            ],
            [
                'key' => 'name',
                'name' => 'Name',
                'render' => function ($item) {
                    return $item->name;
                }
            ],
            [
                'key' => 'email',
                'name' => 'Email',
                'render' => function ($item) {
                    return $item->email;
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
