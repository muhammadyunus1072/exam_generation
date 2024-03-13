<?php

namespace App\Livewire\User;

use App\Helpers\Alert;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class Filter extends Component
{
    #[Validate('required')]
    public $name = '';
    #[Validate('required')]
    public $email = '';

    public $password = '';

    public $is_verified = false;
    public $role;
    public $user_id;
    public $is_edit;

    public function save()
    {
        $this->validate();
        try {
            DB::beginTransaction();

            if ($this->is_edit) {
                $user = User::find($this->user_id);

                $user->name = $this->name;
                if (!empty($this->password)) {
                    $user->password = Hash::make($this->password);
                }
                $user->save();
                if ($this->role) {
                    if (Role::where('name', $this->role)->exists()) {
                        if (!$user->hasRole($this->role)) {
                            $roles = $user->getRoleNames();
                            foreach ($roles as $role) {
                                $user->removeRole($role);
                            }
                            $user->assignRole($this->role);
                        }
                        DB::commit();
                        Alert::success($this, 'Success', 'Your account have been registered successfully');
                    } else {
                        DB::rollBack();
                        Alert::fail($this, 'Fail', 'Role not found');
                    }
                }
                DB::commit();
                Alert::success($this, 'Success', 'Your account have been registered successfully');
            } else {
                $user = User::where('email', $this->email)->first();
                if ($user) {
                    Alert::fail($this, 'Fail', 'This email address is already registered. Please try a different email address');
                } else {
                    $user = new User();
                    $user->name = $this->name;
                    $user->email = $this->email;
                    if (empty($this->password)) {
                        DB::rollBack();
                        Alert::fail($this, 'Fail', 'Password Required');
                        return;
                    }
                    $user->password = Hash::make($this->password);
                    if ($this->is_verified) {
                        $user->email_verified_at = Carbon::now();
                        $user->save();
                        if ($this->role) {
                            if (Role::where('name', $this->role)->exists()) {
                                $user->assignRole($this->role);
                                DB::commit();
                                Alert::success($this, 'Success', 'Your account have been registered successfully');
                            } else {
                                DB::rollBack();
                                Alert::fail($this, 'Fail', 'Your account have been registered successfully');
                            }
                        } else {
                            DB::commit();
                        }
                        Alert::success($this, 'Success', 'Your account have been registered successfully');
                    } else {
                        $user->save();
                        $user->sendEmailVerificationNotification();
                        DB::commit();
                        Alert::success($this, 'Success', 'Email Verification Sent Successfully. Please Check Your Email');
                    }
                }
            }
            $this->dispatch('refreshDatatable');
            $this->reset();
        } catch (Exception $e) {
            DB::rollBack();

            $this->dispatch('consoleLog', "Failed to save data.");
        }
    }

    public function resetInput(){
        $this->reset();
    }

    public function updatedIsVerified($value)
    {
        $this->dispatch('initSelect2');
    }

    #[On('editDetail')]
    public function editDetail($id)
    {
        if ($id) {
            $user = User::find($id);
            if ($user) {
                $this->user_id = $user->id;
                $this->name = $user->name;
                $this->email = $user->email;
                $this->password = '';
                $this->is_edit = true;
                $this->dispatch('initSelect2');
                $this->dispatch('addSelect2Role', role: $user->getRoleNames());
            }
        }
    }

    public function render()
    {
        return view('livewire.user.filter');
    }
}
