<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComment;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of article's comment.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Comment $comment)
    {
        $comment = Comment::with(['user', 'article'])->get();

        return response()->json(['data' => $comment], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreComment  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComment $request)
    {
        $data = $request->only('content', 'article_id');
        $data['user_id'] = auth()->user()->id;

        $comment = Comment::create($data);
        return response()->json(['msg' => 'Article comment added', 'data' => $comment], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        $comment->load('user', 'article');
        return response()->json(['data' => $comment], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id != auth()->user()->id) {
            return response()->json(['msg' => 'can not be deleted']);
        }

        $comment->delete();
        return response()->json(['msg' => 'comment deleted'], 200);
    }
}
