<?php

namespace App\Livewire\Permission;

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
    
    public $permission_id;
    public $is_edit;

    public function savePermission(){
        
        try{
            DB::beginTransaction();
            if(!$this->permission_name){
                $this->dispatch('onFailSweetAlert', 'Permission Name Required');
                DB::rollBack();
                return;
            }
            if($this->is_edit){
                $permission = Permission::find($this->permission_id);
                $permission->name = $this->permission_name;
                $permission->save();
            }else{
                $permission = Permission::whereName($this->permission_name)->first();
                if($permission){
                    $this->dispatch('onFailSweetAlert', 'This permission is already registered. Please try a different permission');
                    DB::rollBack();
                    return;
                }
                $permission = Permission::create(['name' => $this->permission_name]);
            }
            
            DB::commit();
            $this->dispatch('onSuccessSweetAlert', 'Permission have been registered successfully');
            $this->dispatch('refreshDatatable'); 
            $this->reset(); 
        }catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('consoleLog', "Failed to save data.");
        }
    }

    #[On('editDetail')] 
    public function editDetail($id) {
        $this->dispatch('onSuccessSweetAlert', 'Role have been registered successfully');
        if($id){
            $permission = Permission::find($id);
            if($permission){
                $this->permission_id = $permission->id;
                $this->permission_name = $permission->name;
                $this->is_edit = true;
            }
        }
    }
    public function resetInput() {
        $this->reset(); 
    }
    
    public function render()
    {
        return view('livewire.permission.filter');
    }
}
