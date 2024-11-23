<?php

namespace App\Http\Services;

use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegistrationService
{
    public function register(array $data): UserResource
    {
        $data['password'] = bcrypt($data['password']);
        $data['role_id'] = Role::ROLE_USER_ID;
        $user = User::create($data);

        return new UserResource($user);
    }

    public function login(array $credentials): string
    {
        if (Auth::attempt($credentials)) {
            return Auth::user()->createToken('app')->plainTextToken;
        }

        throw new \Exception('Unable to login');
    }
}
