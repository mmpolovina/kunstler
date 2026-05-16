<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Add User')]

class UserCreateComponent extends Component
{
    public string $name;
    public string $email;
    public string $password;
    public bool $is_admin = false;

    public function save()
    {
        $validate = $this->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'is_admin' => 'boolean',
        ]);

        $validate['password'] = bcrypt($validate['password']);

        User::create($validate);

        session()->flash('success', 'User created successfully!');
        $this->redirectRoute(name: 'admin.users.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.user.user-create-component');
    }
}
