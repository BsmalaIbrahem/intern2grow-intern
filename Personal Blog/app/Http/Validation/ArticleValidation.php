<?php

namespace App\Http\Validation;

use Illuminate\Support\Facades\Validator;

class ArticleValidation
{
    public function store($data)
    {
        return Validator::make($data, [
            'title' => 'required | string',
            'description' => 'required | string',
            'status' => 'required | in:private,public',
        ]);
    }
}
