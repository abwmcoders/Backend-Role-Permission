<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request) {
        //! VALIDATE
        //! REGSIETR USER
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->name),
        ]);

        //! ASSIGN ROLE
        $user_role = Role::where('name', 'user')->first();
        if($user_role) {
            $user->assignRole($user_role);
        }
       //! SEND RESPONSE
        return new UserResource($user);
    }
}
