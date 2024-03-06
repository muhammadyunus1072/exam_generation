<?php

namespace App\Livewire\Permission;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On; 
use App\Traits\WithDatatable;
use App\Helpers\PermissionHelper;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
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
        $item = Permission::find($id);
        $authUser = User::find(Auth::id());
        if (!$authUser->hasPermissionTo("delete permissions")) {
            return;
        }

        $item->delete();
        $this->dispatch('onSuccessSweetAlert', 'Data has been successfully deleted!');
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
                    if ($authUser->hasPermissionTo("edit users")) {
                        $editHtml = "<div class='col-auto'>
                        <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#permissionModal' wire:click=\"\$dispatch('editDetail', { id: '$item->id' })\">
                        <i class='fa fa-edit'></i> Edit
                        </button>
                        </div>";
                    }

                    $destroyHtml = "";
                    if ($authUser->hasPermissionTo("delete users")) {
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
        ];
    }

    public function getQuery(): Builder
    {

        return Permission::query();
    }

    public function getView(): string
    {
        return 'livewire.permission.datatable';
    }
}
