<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::all();
    }
    public function render()
    {
        return view('livewire.users.users');
    }
}
