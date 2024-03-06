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

    public function save()
    {
        $this->validate(); 
 
        User::create(
            $this->only(['title', 'content'])
        );
 
        return $this->redirect('/posts');
    }

    public function render()
    {
        return view('livewire.user.filter');
    }
}
