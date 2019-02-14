<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ShowController extends Controller
{
    public function index(Request $request) {
        //バリデーション処理
        $this->validate($request, ['id' => 'required|integer|min:0']);

        $post = Post::find($request->id);
        if (is_null($post)) return redirect('/');

        $param = [
            'image' => $post->image,
            'file_type' => $post->file_type,
        ];

        return view('show', $param);
    }
}
