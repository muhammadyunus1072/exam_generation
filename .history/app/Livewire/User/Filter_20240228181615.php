<?php

namespace App\Livewire\User;

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
            $this->dispatch('consoleLog','Sudah Ada');
        }else{
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->passowrd = Hash::make($this->password);
            $this->dispatch('consoleLog','Aman');

        }
 

    }

    public function render()
    {
        return view('livewire.user.filter');
    }
}
