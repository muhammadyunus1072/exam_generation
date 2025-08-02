<?php

namespace App\Livewire\Service\PerformRecap;

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
use App\Repositories\Service\ExamUser\ExamUserRepository;

class Datatable extends Component
{
    use WithDatatable;

    public $objId;
    public $isCanUpdate;
    public $isCanDelete;
    public $isCanUpdateBookingTime;
    public $isCanUpdateDetail;

    // Delete Dialog
    public $targetDeleteId;

    public function onMount()
    {
        $authUser = UserRepository::authenticatedUser();
        $this->isCanUpdate = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_PERFORM_RECAP, PermissionHelper::TYPE_UPDATE));
        $this->isCanDelete = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_PERFORM_RECAP, PermissionHelper::TYPE_DELETE));
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
                        $editUrl = route('perform_recap.edit', $id);
                        $editHtml = "<div class='col-auto mb-2'>
                            <a class='btn btn-primary btn-sm' href='$editUrl'>
                                <i class='ki-duotone ki-eye fs-1'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                    <span class='path3'></span>
                                    <span class='path4'></span>
                                    <span class='path5'></span>
                                </i>
                                Detail
                            </a>
                        </div>";
                    }

                    $html = "<div class='row'>
                        $editHtml
                    </div>";

                    return $html;
                },
            ],
            [
                'key' => 'perform_name',
                'name' => 'Nama Peserta',
            ],
            [
                'key' => 'score',
                'name' => 'Nilai',
            ],
            [
                'key' => 'score',
                'name' => 'Status',
                'render' => function ($item) {
                    return $item->score >= $item->minimal_score ? "<span class='badge badge-success'>Lulus</span>" : "<span class='badge badge-danger'>Tidak Lulus</span>";
                }
            ],
        ];
    }

    public function getQuery(): Builder
    {
        return ExamUserRepository::datatable(ExamHelper::simple_decrypt($this->objId));
    }

    public function getView(): string
    {
        return 'livewire.service.perform-recap.datatable';
    }
}
