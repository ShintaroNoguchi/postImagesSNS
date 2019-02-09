<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    //投稿画面表示
    public function index()
    {
        return view('post');
    }

    //投稿処理
    public  function post(PostRequest $request)
    {
        //バリデーション処理
        //$this->validate($request, Post::$rules);

        //DBに投稿を保存
        $post = new Post;
        $post->user_id = $request->user_id;
        $post->comment = $request->comment;
        $post->image = base64_encode(file_get_contents($request->image->getRealPath()));
        $post->save();

        return redirect('/');
    }
}
