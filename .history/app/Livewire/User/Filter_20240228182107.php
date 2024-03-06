<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate; 


class Filter extends Component
{
    #[Validate('required')] 
    public $name = '';
    #[Validate('required')] 
    public $email = '';
    #[Validate('required')] 
    public $password = '';

    public $is_verified = '';

    public function save()
    {
        $this->validate(); 

        $user = User::where('email', $this->email)->first();
        if($user){
            $this->dispatch('onFailSweetAlert', 'This email address is already registered. Please try a different email address');
        }else{
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->passowrd = Hash::make($this->password);
            if($this->is_verified) {
                $user->email_verified_at = Carbon::now();
                $user->save();
            }else{
                $user->save();
                $user->sendEmailVerificationNotification();
            }
        }
 

    }

    public function render()
    {
        return view('livewire.user.filter');
    }
}
