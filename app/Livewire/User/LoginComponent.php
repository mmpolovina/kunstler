<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginComponent extends Component
{

    #[Validate('required|email')]
    public string $email;
        
    #[Validate('required')]
    public string $password;

    public function login()
    {
        $validate = $this->validate();

        if(Auth::attempt($validate)){
            session()->flash('success', 'Login successful.');
            $this->redirectRoute('account', navigate:true);
        }else{
            $this->js(" toastr.error('Login failed')");
            $this->reset();
        }
    }

    public function render()
    {
        return view('livewire.user.login-component');
    }
}
