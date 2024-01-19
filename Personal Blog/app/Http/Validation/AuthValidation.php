<?php

namespace App\Http\Validation;

use Illuminate\Support\Facades\Validator;

class AuthValidation
{
    public function signUp($data)
    {
        return Validator::make($data, [
            'name' => 'required | min:3',
            'email' => 'required| unique:users| email',
            'password' => 'required | confirmed | min:7'
        ]);
    }

    public function login($data)
    {
        return Validator::make($data, [
            'email' => 'required | email | exists:users',
            'password' => 'required',
        ]);
    }
}
