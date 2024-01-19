<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Services\AuthService;

class AuthController extends Controller
{
    private $AuthService;
    public function __construct()
    {
        $this->AuthService = new AuthService();
    }

    public function create_register(){
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $this->AuthService->register($request);
        return redirect()->route('create_login');
    }

    public function create_login(){
        return view('index');
    }


    public function login(LoginRequest $request){
        if(!$this->AuthService->login($request))
            return redirect()->back()->withErrors(['msg' => 'password is wrong']);
        return redirect()->route('home');
    }

    public function logout(){
        session()->flush();
        return redirect()->route('create_login');
    }
}
