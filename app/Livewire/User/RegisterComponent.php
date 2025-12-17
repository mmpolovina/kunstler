<?php

namespace App\Livewire\User;

use App\Livewire\Forms\RegisterForm;
use Livewire\Component;

class RegisterComponent extends Component
{
    public RegisterForm $form;


    public function save()
    {

        $this->form->saveUser();
        session()->flash('success', 'Thanks for registration!');
        $this->redirectRoute('login', navigate:true);
        
    }
    public function render()
    {
        return view('livewire.user.register-component');
    }
}
