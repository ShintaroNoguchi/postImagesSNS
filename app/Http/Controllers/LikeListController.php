<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;

class LikeListController extends Controller
{
    public function index(Request $request) {
        //バリデーション処理
        $this->validate($request, ['id' => 'required|integer|min:0']);

        $post = Post::find($request->id);
        if (is_null($post)) return redirect('/');


        //その投稿に対するいいねの情報を全件取得
        $likes = Like::where('post_id', $request->id)->get();
/*
        $cnt = 0;
        foreach ($likes as $like) {
            if($cnt == 0) $cnt++;
            else exit();

            var_dump($like->user());
        }

exit();
*/
        return view('like_list', ['likes' => $likes]);
    }
}
