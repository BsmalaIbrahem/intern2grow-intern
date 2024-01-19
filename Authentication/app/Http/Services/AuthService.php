<?php

namespace App\Http\Services;

use App\Models\User;

class AuthService{

    public function register($request){
        $user = $this->store($request);
    }

    public function login($request){
        if($this->check_authrized($request)){
            $this->create_session($request);
            return true;
        }
        return false;

    }

    public function store($request){
        $user = User::create($request->all());
        return $user;
    }

    public function create_session($user){
        $user->session()->regenerate();
    }

    public function check_authrized($request){
        $data = $request->only('email', 'password');
        if(!auth()->attempt($data))
            return false;
        return true;
    }
}
