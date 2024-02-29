<?php

namespace App\Livewire\Role;

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
    public $role_id;
    public $role_name;
    
    public $is_edit;

    public $old_permissions = [];
    public $new_permissions = [];
    public $delete_permissions = [];

    public function selectPermission($permission){
        if (!in_array($permission, $this->new_permissions)) {
            $this->new_permissions[] = $permission;
        }
    }
    public function unselectPermission($permission){

        $index = array_search($permission, $this->old_permissions);
        if ($index !== false) {
            unset($this->old_permissions[$index]);
            if (!in_array($permission, $this->delete_permissions)) {
                $this->delete_permissions[] = $permission;
            }
        }
    }
    public function saveRole(){
        try{
            DB::beginTransaction();
            if(!$this->role_name){
                $this->dispatch('onFailSweetAlert', 'Role Name Required');
                DB::rollBack();
                return;
            }
            if($this->is_edit){
                $role = Role::find($this->role_id);
                $role->name = $this->role_name;
                $role->save();
                foreach($this->delete_permissions as $delete_permission){
                    $role->revokePermissionTo($delete_permission);
                }
                foreach($this->new_permissions as $new_permission){
                    $role->givePermissionTo($new_permission);
                }
            }else{
                $role = Role::whereName($this->role_name)->first();
                if($role){
                    $this->dispatch('onFailSweetAlert', 'This Role is already registered. Please try a different Role');
                    DB::rollBack();
                    return;
                }
                $role = Role::create(['name' => $this->role_name]);

                foreach($this->new_permissions as $new_permission){
                    $role->givePermissionTo($new_permission);
                }
            }
            
            DB::commit();
            $this->dispatch('onSuccessSweetAlert', 'Role have been registered successfully');
            $this->dispatch('refreshDatatable'); 
             $this->dispatch('setSelectedPermissions', [[]])''
            $this->reset(
                'is_edit',
                'role_id',
                'role_name',
                'old_permissions',
                'new_permissions',
                'delete_permissions',
                'delete_permissions'
            ); 
        }catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('consoleLog', "Failed to save data.");
        }
    }

    #[On('editDetail')] 
    public function editDetail($id) {
        if($id){
            $role = Role::find($id);
            if($role){
                $this->role_id = $role->id;
                $this->role_name = $role->name;
                $this->old_permissions = $role->permissions->pluck('name')->toArray();
                $this->is_edit = true;
                $this->dispatch('setSelectedPermissions', $role->permissions);
            }
        }
    }
    public function resetInput() {
        $this->reset(
            'is_edit',
            'role_id',
            'role_name',
            'old_permissions',
            'new_permissions',
            'delete_permissions',
            'delete_permissions'
        ); 
    }
    
    public function render()
    {
        return view('livewire.role.filter');
    }
}
