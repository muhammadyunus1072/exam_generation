<?php

namespace App\Livewire\Documentation;

use Carbon\Carbon;
use App\Helpers\Alert;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Traits\WithDatatable;
use App\Helpers\PermissionHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Documentation\DocumentationRepository;

class Datatable extends Component
{
    use WithDatatable;
    public $isCanUpdate;
    public $isCanDelete;

    // Filter
    public $role;

    // Delete Dialog
    public $targetDeleteId;

    public function onMount()
    {
        $authUser = DocumentationRepository::authenticatedUser();
        $this->isCanUpdate = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_DOCUMENTATION, PermissionHelper::TYPE_UPDATE));
        $this->isCanDelete = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_DOCUMENTATION, PermissionHelper::TYPE_DELETE));
    }

    #[On('refreshDatatable')]
    public function refreshDatatable()
    {
        $this->dispatch('$refresh');
    }

    #[On('on-delete-dialog-confirm')]
    public function onDialogDeleteConfirm()
    {
        if (!$this->isCanDelete || $this->targetDeleteId == null) {
            return;
        }

        RoleRepository::delete($this->targetDeleteId);
        Alert::success($this, 'Berhasil', 'Data berhasil dihapus');
    }

    #[On('on-delete-dialog-cancel')]
    public function onDialogDeleteCancel()
    {
        $this->targetDeleteId = null;
    }

    public function showDeleteDialog($id)
    {
        $this->targetDeleteId = $id;

        Alert::confirmation(
            $this,
            Alert::ICON_QUESTION,
            "Hapus Data",
            "Apakah Anda Yakin Ingin Menghapus Data Ini ?",
            "on-delete-dialog-confirm",
            "on-delete-dialog-cancel",
            "Hapus",
            "Batal",
        );
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
                        $editUrl = route('role.edit', $item->id);
                        $editHtml = "<div class='col-auto mb-2'>
                            <button class='btn btn-primary btn-sm' type='button' data-bs-toggle='modal' data-bs-target='#editModal' @click=\"\$dispatch('editDetail', { id: '$item->id' })\">
                                <i class='ki-duotone ki-notepad-edit fs-1'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                </i>
                                Ubah
                            </button>
                        </div>";
                    }

                    $destroyHtml = "";
                    if ($this->isCanDelete) {
                        $destroyHtml = "<div class='col-auto mb-2'>
                            <button class='btn btn-danger btn-sm m-0' 
                                wire:click=\"showDeleteDialog($item->id)\">
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

                    $showUrl = route('documentation.show', ['id' => $item->id]);
                    $showHtml = "<div class='col-auto mb-2'>
                    <a href='$showUrl'target='_blank' class='btn btn-sm btn-primary'><i class='fa fa-eye'></i> show</a>
                    </div>";

                    $html = "<div class='row'>
                        $editHtml $destroyHtml $showHtml
                    </div>";

                    return $html;
                    $editHtml = "";
                    if ($this->isCanUpdate) {
                        $editHtml = "<div class='col-auto'>
                        <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' wire:click=\"\$dispatch('editDetail', { id: '$item->id' })\">
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
        return DocumentationRepository::datatable();
    }

    public function getView(): string
    {
        return 'livewire.documentation.datatable';
    }
}
