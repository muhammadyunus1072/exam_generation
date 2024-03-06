<?php

namespace App\Livewire\User;

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

    public function render()
    {
        return view('livewire.user.filter');
    }
}
