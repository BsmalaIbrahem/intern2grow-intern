<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Validation\AuthValidation;
use App\Http\Resources\AuthResource;

class AuthController extends Controller
{
    private $service; private $validationService;

    public function __construct(AuthValidation $validation)
    {
        $this->service = new AuthService();
        $this->validationService = $validation;
    }

    public function signUp(Request $request)
    {
        $validator = $this->validationService->signUp($request->all());
        if($validator->fails()){
            return response(['error' => $validator->errors()], 422);
        }
        $user = $this->service->createUser($request->all());
        return AuthResource::make($user, $this->service->createToken($user));
    }

    public function login(Request $request)
    {
        $validator = $this->validationService->login($request->all());
        if($validator->fails()){
            return response(['error' => $validator->errors()], 422);
        }
        if(!$this->service->checkLogin($request->all())){
            return response(['error' => 'password is wrong'], 422);
        }
        $user = $request->user();
        return  AuthResource::make($user, $this->service->createToken($user));
    }
}
