<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate; 
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On; 


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
                        $user->assignRole($this->role);
                        DB::commit();
                        $this->dispatch('onSuccessSweetAlert', 'Your account have been registered successfully');
                    }else{
                        DB::rollBack();
                        $this->dispatch('onFailSweetAlert', 'Your account have been registered successfully');
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
            $this->reset(); 

        }catch (\Exception $e) {
            DB::rollBack();
            $this->emit('onFailSweetAlert', "Kursus gagal masuk keranjang.");
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
        $this->reset(); 
    }
    
    public function render()
    {
        return view('livewire.user.filter');
    }
}
