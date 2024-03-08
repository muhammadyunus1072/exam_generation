<?php

namespace App\Livewire\Account\Role;

use App\Helpers\Alert;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Traits\WithDatatable;
use App\Helpers\PermissionHelper;
use Spatie\Permission\Models\Role;
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

    #[On('refreshDatatable')]
    public function refreshDatatable()
    {
        $this->dispatch('$refresh');
    }
    #[On('addFilter')]
    public function addFilter($filter)
    {
        foreach ($filter as $key => $value) {
            $this->$key = $value;
        }
    }
    public function destroy($id)
    {
        $item = User::find($id);
        $authUser = User::find(Auth::id());
        if (!$authUser->hasPermissionTo("delete roles")) {
            return;
        }

        $item->delete();
        Alert::success($this, 'Success', 'Data has been successfully deleted!');
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
                    if ($authUser->hasPermissionTo("edit roles")) {
                        $editHtml = "<div class='col-auto'>
                        <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#roleModal' wire:click=\"\$dispatch('editDetail', { id: '$item->id' })\">
                        <i class='fa fa-edit'></i> Edit
                        </button>
                        </div>";
                    }

                    $destroyHtml = "";
                    if ($authUser->hasPermissionTo("delete roles")) {
                        $destroyHtml = "<div class='col-auto'>
                            <form wire:submit.prevent=\"destroy('$item->id')\">"
                            . method_field('DELETE') . csrf_field() .
                            "<button type='submit' class='btn btn-danger btn-sm'
                                    onclick=\"return confirm('Delete Data?')\">
                                    <i class='fa fa-trash mr-2'></i>Delete
                                </button>
                            </form>
                        </div>
                        ";
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
                'sortable' => false,
                'searchable' => false,
                'name' => 'Permission',
                'render' => function ($item) {
                    $permissions = Role::find($item->id)->permissions;

                    $html = "<ul class='list-group list-group-flush'>";
                    foreach ($permissions as $permission) {
                        $html .= "<li class='list-group-item'>$permission->name</li>";
                    }
                    $html .= "</ul>";
                    return $html;
                }
            ],
        ];
    }

    public function getQuery(): Builder
    {
        $start_date = $this->start_date . " 00:00:00";
        $end_date = $this->end_date . " 23:59:59";

        return Role::query();
    }

    public function getView(): string
    {
        return 'livewire.role.datatable';
    }
}
