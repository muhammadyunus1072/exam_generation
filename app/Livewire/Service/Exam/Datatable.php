<?php

namespace App\Livewire\Service\Exam;

use App\Helpers\Alert;
use Livewire\Component;
use App\Helpers\ExamHelper;
use Livewire\Attributes\On;
use App\Helpers\PermissionHelper;

use Illuminate\Support\Facades\Crypt;
use App\Traits\Livewire\WithDatatable;
use App\Models\MasterData\PaymentMethod;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Account\UserRepository;
use App\Repositories\Service\Exam\ExamRepository;
use App\Repositories\MasterData\PaymentMethod\PaymentMethodRepository;

class Datatable extends Component
{
    use WithDatatable;

    public $isCanUpdate;
    public $isCanDelete;
    public $isCanUpdateBookingTime;
    public $isCanUpdateDetail;

    // Delete Dialog
    public $targetDeleteId;

    public function onMount()
    {
        $authUser = UserRepository::authenticatedUser();
        $this->isCanUpdate = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_EXAM, PermissionHelper::TYPE_UPDATE));
        $this->isCanDelete = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_EXAM, PermissionHelper::TYPE_DELETE));
    }

    #[On('on-delete-dialog-confirm')]
    public function onDialogDeleteConfirm()
    {
        if (!$this->isCanDelete || $this->targetDeleteId == null) {
            return;
        }

        ExamRepository::delete(ExamHelper::simple_decrypt($this->targetDeleteId));
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
                'name' => 'Aksi',
                'sortable' => false,
                'searchable' => false,
                'render' => function ($item) {

                    $editHtml = "";
                    $id = ExamHelper::simple_encrypt($item->id);
                    if ($this->isCanUpdate) {
                        $editUrl = route('exam.edit', $id);
                        $editHtml = "<div class='col-auto mb-2'>
                            <a class='btn btn-primary btn-sm' href='$editUrl'>
                                <i class='ki-duotone ki-notepad-edit fs-1'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                </i>
                                Detail
                            </a>
                        </div>";
                    }

                    $destroyHtml = "";
                    if ($this->isCanDelete) {
                        $destroyHtml = "<div class='col-auto mb-2'>
                            <button class='btn btn-danger btn-sm m-0' 
                                wire:click=\"showDeleteDialog('$id')\">
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

                    $performRecapUrl = route('perform_recap.index', $id);
                    $performRecapHtml = "<div class='col-auto mb-2'>
                            <a class='btn btn-success btn-sm' href='$performRecapUrl'>
                                <i class='ki-duotone ki-eye fs-1'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                    <span class='path3'></span>
                                    <span class='path4'></span>
                                </i>
                                Rekap Pengerjaan
                            </a>
                        </div>";

                    $html = "<div class='row'>
                        $editHtml $destroyHtml $performRecapHtml
                    </div>";

                    return $html;
                },
            ],
            [
                'key' => 'level',
                'name' => 'Jenjang Pendidikan',
            ],
            [
                'key' => 'grade',
                'name' => 'Kelas',
            ],
            [
                'key' => 'subject',
                'name' => 'Mata Pelajaran',
            ],
        ];
    }

    public function getQuery(): Builder
    {
        return ExamRepository::datatable();
    }

    public function getView(): string
    {
        return 'livewire.service.exam.datatable';
    }
}
