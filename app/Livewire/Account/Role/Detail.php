<?php

namespace App\Livewire\Account\Role;

use Exception;
use App\Helpers\Alert;
use App\Helpers\PermissionHelper;
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

    public $accesses = [];

    public function mount()
    {
        foreach (PermissionHelper::ACCESS_ALL as $access) {
            $this->accesses[$access] = [
                'name' => PermissionHelper::TRANSLATE_ACCESS[$access],
                'permissions' => []
            ];
        }

        $permissions = Permission::select('id', 'name')->orderBy('name')->get();
        foreach ($permissions as $permission) {
            $this->accesses[PermissionHelper::getAccess($permission->name)]['permissions'][] = [
                'id' => $permission->id,
                'name' => $permission->name,
                'translated_name' => PermissionHelper::getTranslatedType($permission->name),
                'is_checked' => false,
            ];
        }

        if ($this->objId) {
            $role = Role::find($this->objId);
            $this->name = $role->name;

            foreach ($role->permissions as $rolePermission) {
                foreach ($this->accesses as $keyAccess => $access) {
                    foreach ($access['permissions'] as $keyPermission => $permission) {
                        if ($rolePermission->id == $permission['id']) {
                            $this->accesses[$keyAccess]['permissions'][$keyPermission]['is_checked'] = true;
                            break;
                        }
                    }
                }
            }
        }
    }

    public function store()
    {
        $this->validate();

        $selectedPermissions = [];
        foreach ($this->accesses as $access) {
            foreach ($access['permissions'] as $permission) {
                if ($permission['is_checked']) {
                    $selectedPermissions[] = $permission['name'];
                }
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
