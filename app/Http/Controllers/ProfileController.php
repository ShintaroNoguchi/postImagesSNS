<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        //バリデーション処理
        $this->validate($request, ['id' => 'required|integer|min:0']);

        $user = User::find($request->id);
        if (is_null($user)) return redirect('/');

        //いいねの数を数え上げ
        $num_of_likes = 0;
        foreach ($user->posts as $post) {
            $num_of_likes += $post->countLikes();
        }

        $param = [
            'avatar_url' => $user->avatar_url,
            'name' => $user->name,
            'num_of_likes' => $num_of_likes,
            'posts' => $user->posts()->orderBy('updated_at', 'asc')->get(['id', 'thumbnail', 'file_type']),
        ];

        return view('profile', $param);
    }
}
