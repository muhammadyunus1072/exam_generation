<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Validate; 

class Filter extends Component
{
    #[Validate('required')] 
    public $title = '';
    
    public function render()
    {
        return view('livewire.user.filter');
    }
}
