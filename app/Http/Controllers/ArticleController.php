<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::paginate(15);

        // return ArticleResource::collection($articles);
        
        return $articles;
    }

    public function store(Request $request)
    {
        $article = $request->isMethod('put') ? Article::findOrFail($request->id): new Article;

        $article->id = $request->input('id');
        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if($article->save()){
            return new ArticleResource($article);
        }
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);

        return new ArticleResource($article);
        // return $article;
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if($article->delete()){
            return new ArticleResource($article);
        }
    }
}
