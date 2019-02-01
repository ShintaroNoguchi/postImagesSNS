<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
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
}
