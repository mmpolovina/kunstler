<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Update User')]

class UserEditComponent extends Component
{   
    public User $user;
    public string $name;
    public string $email;
    public bool $is_admin;  
    public string $password;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->is_admin = $user->is_admin;
    }

        public function save()
    {
        $validate = $this->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $this->user->id,
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'nullable|string|min:6',
            'is_admin' => 'boolean',
        ]);

        if (!$validate['password']) {
            unset($validate['password']);
        } 

        $this->user->update($validate);

        session()->flash('success', 'User updated successfully!');
        $this->redirectRoute(name: 'admin.users.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.user.user-edit-component');
    }
}
