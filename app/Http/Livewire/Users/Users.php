<?php

namespace App\Http\Livewire\Users;

use App\Http\Controllers\Users\UsersController;
use App\Models\CatalogRoles;
use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $users;
    
    public $catalog_roles;

    protected $listeners = [
        'createUser' => 'createUser'
    ];
    public function mount()
    {
        $this->users = User::all();
       
        $this->catalog_roles = CatalogRoles::where('asset',1)->get();
    }
    public function render()
    {
        
        return view('livewire.users.users');
    }

    public function createUser($data)
    {
        $userController = new UsersController();
        $result= $userController->create($data);
        
        if ($result['result'] == 'success') {
            $this->alert('success','Exíto', $result['message']);
            $this->users = User::all();
        }else{
            $this->alert('error','Error', $result['message']);
        }
    }
}
