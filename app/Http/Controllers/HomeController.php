<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'asc')->simplePaginate(10);
        return view('home', ['posts' => $posts]);
    }

    //投稿の削除
    public function delete(Request $request)
    {
        //バリデーション処理
        $this->validate($request, Post::$delete_rules);

        $post = Post::where('id', $request->id)->where('user_id', Auth::user()->id)->first();
        if (isset($post)) $post->delete();

        return redirect('/');
    }

    //いいねした際の処理
    public function like(Request $request)
    {
        //バリデーション処理
        $this->validate($request, Like::$rules);

        $like = new Like;
        $like->user_id = Auth::user()->id;
        $like->post_id = $request->post_id;
        $like->save();

        return redirect('/');
    }

    //いいねを外した際の処理
    public function dislike(Request $request)
    {
        //バリデーション処理
        $this->validate($request, Like::$rules);

        Like::where('user_id', Auth::user()->id)->where('post_id', $request->post_id)->delete();

        return redirect('/');
    }
}
