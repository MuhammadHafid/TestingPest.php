<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticle;
use App\Http\Requests\UpdateArticle;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Article::with(['user', 'category'])->get();
        return response()->json(['Data Article' => $article], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreArticle  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
        $data = $request->only('title', 'content', 'category_id');
        $data['user_id'] = auth()->user()->id;

        $article = Article::create($data);
        return response()->json(['msg' => 'Article Added', 'data' => $article], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->loadCount('comments');

        return response()->json(['data' => $article], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateArticle  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticle $request, Article $article)
    {
        $article->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return response()->json(['msg' => 'Article Updated', 'data' => $article], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if ($article->user_id != auth()->user()->id) {
            return response()->json(['msg' => "Invalid Article Author"]);
        }

        $article->delete();
        return response()->json(['msg' => "Article Deleted"], 200);
    }
}
