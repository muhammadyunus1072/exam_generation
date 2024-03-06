<?php

namespace App\Livewire\RolePermission;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate; 
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;


class Filter extends Component
{

    
    public $permission_name;
    
    public $role_name;
    
    public $is_edit;

    public function savePermission(){
        
        try{
            DB::beginTransaction();
            $permission = Permission::whereName($this->permission_name)->first();
            if($permission){
                $this->dispatch('onFailSweetAlert', 'This permission is already registered. Please try a different permission');
                return;
            }
            $permission = Permission::create(['name' => $this->permission_name]);
            
            DB::commit();
            $this->dispatch('onSuccessSweetAlert', 'Permission have been registered successfully');
            $this->dispatch('refreshDatatable'); 
            $this->reset(); 
        }catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('consoleLog', "Failed to save data.");
        }
    }
    public function saveRole(){
        $this->validate(); 
        try{
            DB::beginTransaction();
            $role = Role::whereName($this->role_name)->first();
            if($role){
                $this->dispatch('onFailSweetAlert', 'This role is already registered. Please try a different role');
                return;
            }
            $role = Role::create(['name' => $this->role_name]);
            
            DB::commit();
            $this->dispatch('onSuccessSweetAlert', 'role have been registered successfully');
            $this->dispatch('refreshDatatable'); 
            $this->reset(); 
        }catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('consoleLog', "Failed to save data.");
        }
    }

    public function save()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();

            if($this->is_edit){
                $user = User::find($this->user_id);
                
                $user->name = $this->name;
                if(!empty($this->password)){
                    $user->password = Hash::make($this->password);
                }
                $user->save();
                if($this->role){
                    if (Role::where('name', $this->role)->exists()) {
                        if(!$user->hasRole($this->role)){
                            $roles = $user->getRoleNames();
                            foreach($roles as $role){
                                $user->removeRole($role);
                            }
                            $user->assignRole($this->role);
                        }
                        DB::commit();
                        $this->dispatch('onSuccessSweetAlert', 'Your account have been registered successfully');
                    }else{
                        DB::rollBack();
                        $this->dispatch('onFailSweetAlert', 'Role not found');
                    }
                }
                DB::commit();
                $this->dispatch('onSuccessSweetAlert', 'Your account have been registered successfully');
            }else{
                $user = User::where('email', $this->email)->first();
                if($user){
                    $this->dispatch('onFailSweetAlert', 'This email address is already registered. Please try a different email address');
                }else{
                    $user = new User();
                    $user->name = $this->name;
                    $user->email = $this->email;
                    if(empty($this->password)){
                        DB::rollBack();
                        $this->dispatch('onFailSweetAlert', 'Password Required');
                        return;
                    }
                    $user->password = Hash::make($this->password);
                    if($this->is_verified) {
                        $user->email_verified_at = Carbon::now();
                        $user->save();
                        if($this->role){
                            if (Role::where('name', $this->role)->exists()) {
                                $user->assignRole($this->role);
                                DB::commit();
                                $this->dispatch('onSuccessSweetAlert', 'Your account have been registered successfully');
                            }else{
                                DB::rollBack();
                                $this->dispatch('onFailSweetAlert', 'Your account have been registered successfully');
                            }
                        }else{
                            DB::commit();
                        }
                        $this->dispatch('onSuccessSweetAlert', 'Your account have been registered successfully');
                    }else{
                        $user->save();
                        $user->sendEmailVerificationNotification();
                        DB::commit();
                        $this->dispatch('onSuccessSweetAlert', 'Email Verification Sent Successfully. Please Check Your Email');
                    }
                    
                }
            }
            $this->dispatch('refreshDatatable'); 
            $this->reset(); 

        }catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('consoleLog', "$e");
            // $this->dispatch('consoleLog', "Failed to save data.");
        }
    }

    public function updatedIsVerified($value){
        $this->dispatch('initSelect2');
    }

    #[On('editDetail')] 
    public function editDetail($id) {
        if($id){
            $user = User::find($id);
            if($user){
                $this->user_id = $user->id;
                $this->name = $user->name;
                $this->email = $user->email;
                $this->password = '';
                $this->is_edit = true;
                $this->dispatch('initSelect2');
                $this->dispatch('addSelect2Role', role: $user->getRoleNames());
            }
        }
        // $this->dispatch('onSuccessSweetAlert', "Edit Detail $id");
    }
    public function resetInput() {
        // $this->reset(); 
    }
    
    public function render()
    {
        return view('livewire.role-permission.filter');
    }
}
