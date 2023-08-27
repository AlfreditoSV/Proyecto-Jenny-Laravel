<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Actions\Fortify\CreateNewUser;
use App\Models\CatalogRoles;
use App\View\Components\table\tr;
use Illuminate\Http\Request;
use Throwable;

class UsersController extends Controller
{
    public $catalog_roles;

    public function __construct()
    {
        $this->catalog_roles = CatalogRoles::all();
    }

    public function index()
    {
        $catalog_roles = $this->catalog_roles;
        return view('admin.users.index', ['catalog_roles' => $catalog_roles]);
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'rol' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);
            $user = new CreateNewUser();
            $user->create($request->all());
            $result = [
                'result' => 'success',
                'message' => 'Usuario creado correctamente'
            ];
            dd($result);
            return $result;
        } catch (Throwable $th) {
            $result = [
                'result' => 'error',
                'message' => 'Error al crear usuario : ' . $th->getMessage()
            ];
            dd($result);
            return $result;
        }
    }
}
