<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Throwable;


class UsersController extends Controller
{
    
    public function index()
    {
        
        return view('admin.users.index');
    }

    public function create($request)
    {
        try {
            $validator = Validator::make($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|confirmed|min:8',
                'rol' => 'required|integer',
            ]);
        
            if ($validator->fails()) {
                return [
                    'result' => 'error',
                    'message' =>  $validator->errors()->first()
                ];
            }
            $user = new CreateNewUser();
            $user->create($request);
            $result = [
                'result' => 'success',
                'message' => 'Usuario creado correctamente'
            ];
            return $result;
        } catch (Throwable $th) {
            $result = [
                'result' => 'error',
                'message' => 'Error al crear usuario : ' . $th->getMessage()
            ];
            return $result;
        }
    }
}
