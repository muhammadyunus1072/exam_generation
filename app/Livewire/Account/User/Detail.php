<?php

namespace App\Livewire\Account\User;

use Exception;
use App\Helpers\Alert;
use App\Repositories\Account\PermissionRepository;
use App\Repositories\Account\UserRepository;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;

class Detail extends Component
{
    public $objId;

    public $roles = [];

    #[Validate('required', message: 'Nama Harus Diisi', onUpdate: false)]
    public $name;

    #[Validate('required', message: 'Email Harus Diisi', onUpdate: false)]
    #[Validate('email', message: "Format Email Tidak Sesuai", onUpdate: false)]
    public $email;

    #[Validate('required', message: 'Jabatan Harus Dipilih', onUpdate: false)]
    public $role;

    public $password;


    public function mount()
    {
        $this->roles = Role::orderBy('name')->pluck('name');
        $this->role = $this->roles[0];

        if ($this->objId) {
            $user = UserRepository::find($this->objId);

            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->roles[0]->name;
        }
    }

    public function store()
    {
        $this->validate();

        $otherUser = UserRepository::findByEmail($this->email);
        if (!empty($otherUser) && $otherUser->id != $this->objId) {
            Alert::fail($this, "Gagal", "Email telah digunakan pada akun yang lainnya. Silahkan gunakan email lain.");
            return;
        }

        if (empty($this->objId) && empty($this->password)) {
            Alert::fail($this, "Gagal", "Password Harus Diisi");
            return;
        }

        $validatedData = [
            'name' => $this->name,
            'email' => $this->email,
        ];
        if (!empty($this->password)) {
            $validatedData['password'] = Hash::make($this->password);
        }

        try {
            DB::beginTransaction();
            if ($this->objId) {
                UserRepository::update($this->objId, $validatedData);
                $user = UserRepository::find($this->objId);
                $user->syncRoles($this->role);
                Alert::success($this, 'Berhasil', 'Pengguna berhasil diperbarui');
            } else {
                $user = UserRepository::create($validatedData);
                $user->assignRole($this->role);
                Alert::success($this, 'Berhasil', 'Pengguna berhasil dibuat');
            }
            DB::commit();

            $this->redirectRoute('user.index');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.account.user.detail');
    }
}
