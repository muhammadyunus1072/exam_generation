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
 
        User::create(
            $this->only(['name', 'email', 'password'])
        );
 
        return $this->redirect('/posts');
    }

    public function render()
    {
        return view('livewire.user.filter');
    }
}
