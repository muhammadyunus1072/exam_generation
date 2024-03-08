<?php

namespace App\Livewire\Account\Permission;

use App\Helpers\Alert;
use App\Helpers\PermissionHelper;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Traits\WithDatatable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;

class Datatable extends Component
{
    use WithDatatable;

    public $isCanUpdate;
    public $isCanDelete;

    public function onMount()
    {
        $this->sortDirection = 'desc';

        $authUser = User::find(Auth::id());
        $this->isCanUpdate = $authUser->hasPermissionTo(PermissionHelper::TYPE_UPDATE . " " . PermissionHelper::ACCESS_PERMISSION);
        $this->isCanDelete = $authUser->hasPermissionTo(PermissionHelper::TYPE_DELETE . " " . PermissionHelper::ACCESS_PERMISSION);
    }

    public function destroy($id)
    {
        if (!$this->isCanDelete) {
            return;
        }

        $item = Permission::find($id);
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

                    $editHtml = "";
                    if ($this->isCanUpdate) {
                        $editHtml = "<div class='col-auto'>
                            <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#permissionModal' wire:click=\"\$dispatch('editDetail', { id: '$item->id' })\">
                                <i class='fa fa-edit'></i> Edit
                            </button>
                        </div>";
                    }

                    $destroyHtml = "";
                    if ($this->isCanDelete) {
                        $destroyHtml = "<div class='col-auto'>
                            <form wire:submit.prevent=\"destroy('$item->id')\">"
                            . method_field('DELETE') . csrf_field() .
                            "<button type='submit' class='btn btn-danger btn-sm'
                                    onclick=\"return confirm('Delete Data?')\">
                                    <i class='fa fa-trash mr-2'></i>Delete
                                </button>
                            </form>
                        </div>";
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
        return 'livewire.account.permission.datatable';
    }
}
