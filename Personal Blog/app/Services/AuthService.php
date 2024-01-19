<?php

namespace App\Services;

use App\Models\User;

class AuthService
{

    public function createUser($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function createToken($user)
    {
        return $user->createToken('apiToken')->plainTextToken;
    }

    public function checkLogin($data)
    {
        if(!auth()->attempt($data))
        {
            return false;
        }
        return true;
    }
}
