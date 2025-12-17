<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
 
    #[Validate('required|min:2|max:255')]
    public string $name;

    #[Validate('required|email|max:255|unique:users,email')]
    public string $email;
        
    #[Validate('required|min:6')]
    public string $password;

    public function saveUser()
    {
        $validate = $this->validate();
        User::create($validate);

    }
}
