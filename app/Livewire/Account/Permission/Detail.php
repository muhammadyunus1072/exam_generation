<?php

namespace App\Livewire\Account\Permission;

use Exception;
use App\Helpers\Alert;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Permission;


class Detail extends Component
{
    public $objId;

    #[Validate('required', message: 'Nama Harus Diisi', onUpdate: false)]
    public $name;

    public function mount()
    {
        if ($this->objId) {
            $permission = Permission::find($this->objId);

            $this->name = $permission->name;
        }
    }

    public function store()
    {
        $this->validate();

        $permission = Permission::whereName($this->name)->first();
        if (!empty($permission) && $permission->id != $this->objId) {
            Alert::fail($this, 'Gagal', "Permission dengan nama {$this->name} sudah pernah dibuat");
            return;
        }


        try {
            DB::beginTransaction();
            if ($this->objId) {
                $permission = Permission::find($this->objId);
                $permission->name = $this->name;
                $permission->save();
                Alert::success($this, 'Berhasil', 'Permission berhasil diperbarui');
            } else {
                $permission = Permission::whereName($this->name)->first();
                Permission::create(['name' => $this->name]);
                Alert::success($this, 'Berhasil', 'Permission berhasil dibuat');
            }
            DB::commit();

            $this->redirectRoute('permission.index');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.account.permission.detail');
    }
}
