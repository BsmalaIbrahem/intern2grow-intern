<?php

namespace App\Validation;

use Illuminate\Support\Facades\Validator;

class ProxyValidation
{
    public function checkRequests($request)
    {
        return Validator::make($request, [
            'key' => 'required| in:get,post,put,delete',
            'url' => 'required | url:http, https',
            'header' => 'nullable| array',
            'body' => 'nullable | array',
        ]);
    }
}
