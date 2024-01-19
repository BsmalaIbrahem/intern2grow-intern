<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
{
    public function store($data)
    {
        Article::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'user_id' => auth()->user()->id,
        ]);
    }

    public function update($data, $id)
    {
        Article::where('id', $id)->where('user_id', auth()->user()->id)->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
        ]);
    }
}
