<?php

namespace App\Livewire\Account\Role;

use App\Helpers\Alert;
use App\Helpers\PermissionHelper;
use App\Models\User;
use Livewire\Component;
use App\Traits\WithDatatable;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Datatable extends Component
{
    use WithDatatable;

    public $isCanUpdate;
    public $isCanDelete;

    public function onMount()
    {
        $authUser = User::find(Auth::id());
        $this->isCanUpdate = $authUser->hasPermissionTo(PermissionHelper::ACCESS_ROLE . " " . PermissionHelper::TYPE_UPDATE);
        $this->isCanDelete = $authUser->hasPermissionTo(PermissionHelper::ACCESS_ROLE . " " . PermissionHelper::TYPE_DELETE);
    }

    public function delete($id)
    {
        if (!$this->isCanDelete) {
            return;
        }

        $item = Role::find($id);
        $item->delete();
        Alert::success($this, 'Success', 'Data has been successfully deleted!');
    }

    public function getColumns(): array
    {
        return [
            [
                'name' => 'Aksi',
                'sortable' => false,
                'searchable' => false,
                'render' => function ($item) {

                    $editHtml = "";
                    if ($this->isCanUpdate) {
                        $editUrl = route('role.edit', $item->id);
                        $editHtml = "<div class='col-auto mb-2'>
                            <a class='btn btn-primary btn-sm' href='$editUrl'>
                                <i class='ki-duotone ki-notepad-edit fs-1'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                </i>
                                Ubah
                            </a>
                        </div>";
                    }

                    $destroyHtml = "";
                    if ($this->isCanDelete) {
                        $destroyHtml = "<div class='col-auto mb-2'>
                            <button class='btn btn-danger btn-sm m-0' 
                                wire:click=\"delete($item->id)\"
                                wire:confirm=\"Apakah Anda Yakin Menghapus Data Ini?\">
                                <i class='ki-duotone ki-trash fs-1'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                    <span class='path3'></span>
                                    <span class='path4'></span>
                                    <span class='path5'></span>
                                </i>
                                Hapus
                            </button>
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
                'name' => 'Nama',
            ],
            [
                'sortable' => false,
                'searchable' => false,
                'name' => 'Permission',
                'render' => function ($item) {
                    $html = "<ul class='list-group list-group-flush'>";
                    foreach ($item->permissions as $permission) {
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
        return Role::with('permissions');
    }

    public function getView(): string
    {
        return 'livewire.role.datatable';
    }
}
