<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
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
    #[Validate('required')] 
    public $password = '';

    public $is_verified = false;
    public $role;

    public function save()
    {
        // $this->dispatch('consoleLog', $this->role);
        $this->validate(); 

        try{
            DB::beginTransaction();

            $user = User::where('email', $this->email)->first();
            if($user){
                $this->dispatch('onFailSweetAlert', 'This email address is already registered. Please try a different email address');
            }else{
                $user = new User();
                $user->name = $this->name;
                $user->email = $this->email;
                $user->password = Hash::make($this->password);
                if($this->is_verified) {
                    $user->email_verified_at = Carbon::now();
                    $user->save();
                    if($this->role){
                        if (Role::where('name', $this->role)->exists()) {
                            $user->assignRole($this->role);
                            $this->dispatch('onSuccessSweetAlert', 'Your account have been registered successfully');
                        }else{
                            DB::rollBack();
                            $this->dispatch('onFailSweetAlert', 'Your account have been registered successfully');
                        }
                    }
                    $this->dispatch('onSuccessSweetAlert', 'Your account have been registered successfully');
                }else{
                    $user->save();
                    $user->sendEmailVerificationNotification();
                    $this->dispatch('onSuccessSweetAlert', 'Email Verification Sent Successfully. Please Check Your Email');
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

    public function render()
    {
        return view('livewire.user.filter');
    }
}
