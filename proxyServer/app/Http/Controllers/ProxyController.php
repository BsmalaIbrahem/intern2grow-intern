<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\ProxyService;
use App\Validation\ProxyValidation;

class ProxyController extends Controller
{
    private $service; private $validation;

    public function __construct()
    {
        $this->service    = new ProxyService();
        $this->validation = new ProxyValidation();
    }

    public function index(Request $request)
    {
        $validator = $this->validation->checkRequests($request->all());
        if($validator->fails())
        {
            return response(['error' => $validator->errors()], 400);
        }
        $response = $this->service->getUrlResponse($request->all());
        if($response->successful()){
            return $response->json();
        }
        return response(['error' => $response->throw()]);
    }
}
