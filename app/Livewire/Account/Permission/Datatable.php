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
                'name' => 'Aksi',
                'sortable' => false,
                'searchable' => false,
                'render' => function ($item) {

                    $editHtml = "";
                    if ($this->isCanUpdate) {
                        $editUrl = route('permission.edit', $item->id);
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
                            <button class='btn btn-danger btn-sm m-0'>
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
