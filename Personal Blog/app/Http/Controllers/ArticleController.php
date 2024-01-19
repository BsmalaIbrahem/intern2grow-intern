<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Validation\ArticleValidation;
use App\Services\ArticleService;
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{
    private $validation; private $service;
    public function __construct()
    {
        $this->validation = new ArticleValidation();
        $this->service    = new ArticleService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::where('status', 'public')->orWhere('user_id', auth()->user()->id)->paginate(5);
        return ArticleResource::collection($articles);
    }

    public function getPersonal()
    {
        $article = Article::where('user_id', auth()->user()->id)->get();
        return ArticleResource::collection($article);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->validation->store($request->all());
        if($validator->fails()){
            return response(['error' => $validator->errors()], 422);
        }
        $this->service->store($request->all());
        return response(['message' => 'successfully created'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function shows($id)
    {
        $article = Article::where('user_id', auth()->user()->id)->Where('id', $id)->get();
        return ArticleResource::make($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validation->store($request->all());
        if($validator->fails()){
            return response(['error' => $validator->errors()], 422);
        }
        $this->service->update($request->all(), $id);
        return response(['message' => 'successfully updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Article::where('user_id', auth()->user()->id)->where('id', $id)->delete();
        return response(['messgae' => 'successfully deleted']);
    }
}
