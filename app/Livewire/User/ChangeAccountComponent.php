<?php

namespace App\Livewire\User;

use Livewire\Component;

class ChangeAccountComponent extends Component
{
    public $name;
    public $email;
    public $password;

    public function mount(): void
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,id,'.auth()->id(),
            'password' => 'nullable|min:6',
        ];
    }

    public function save()
    {
        $user = auth()->user();
        
        $validate = $this->validate();
        if(empty($validate['password'])){
            unset($validate['password']);
        }
        $user->update($validate);

        $this->js("toastr.success('Account details updated successfully!')");
    }

    public function render()
    {
        return view('livewire.user.change-account-component');
    }
}
