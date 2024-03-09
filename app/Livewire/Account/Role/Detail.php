<?php

namespace App\Livewire\Account\Permission;

use Exception;
use App\Helpers\Alert;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Detail extends Component
{
    public $objId;

    #[Validate('required', message: 'Nama Harus Diisi', onUpdate: false)]
    public $name;

    public $permissions = [];

    public function mount()
    {
        $this->permissions = Permission::select(
            'id',
            'name',
            DB::raw("0 as is_selected")
        )
            ->get()
            ->toArray();

        if ($this->objId) {
            $role = Role::find($this->objId);
            $this->name = $role->name;

            foreach ($role->permissions as $rolePermission) {
                foreach ($this->permissions as $index => $permission) {
                    if ($rolePermission->id == $permission['id']) {
                        $this->permissions[$index]['is_selected'] = 1;
                        break;
                    }
                }
            }
        }
    }

    public function store()
    {
        $this->validate();

        $selectedPermissions = [];
        foreach ($this->permissions as $permission) {
            if ($permission['is_selected']) {
                $selectedPermissions[] = $permission['name'];
            }
        }

        try {
            DB::beginTransaction();
            if ($this->objId) {
                $role = Role::find($this->objId);
                $role->update([
                    'name' => $this->name
                ]);
                $role->syncPermissions($selectedPermissions);

                Alert::success($this, 'Berhasil', 'Jabatan berhasil diperbarui');
            } else {
                $role = Role::create([
                    'name' => $this->name
                ]);
                $role->givePermissionTo($selectedPermissions);

                Alert::success($this, 'Berhasil', 'Jabatan berhasil dibuat');
            }
            DB::commit();

            $this->redirectRoute('role.index');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.account.role.detail');
    }
}
