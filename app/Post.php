<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = array('id');


    //投稿時のバリデーション
    public static $rules = array(
        'user_id' => 'required|integer|min:0',
        'comment' => 'nullable|max:200',
        'image' => 'required|max:60000|mimetypes:image/gif,image/jpeg,image/png,video/mp4'
    );

    //投稿削除時のバリデーション
    public static $delete_rules = array(
        'id' => 'required|integer|min:0'
    );


    //主テーブル(usersテーブル)とbelongsTo結合
    public function user() {
        return $this->belongsTo('App\User');
    }

    //従テーブル(likesテーブル)とhasMany結合
    public function likes() {
        return $this->hasMany('App\Like');
    }

    //Userからnameを取得
    public function getName() {
        return $this->user->name;
    }

    //ログインしているユーザがその投稿に対していいねしたかチェックする関数
    //既にいいねした場合はtrueを、まだの場合はfalseを返す
    public function isLiked() {
        $own_like = 0;

        foreach ($this->likes as $like) {
            if ($like['user_id'] == $this->user_id) {
                $own_like = 1;
                break;
            }
        }

        if ($own_like == 1) return true;
        else return false;
    }

    //その投稿に対するいいねの数を返す関数
    public function countLikes() {
        return $this->likes()->count();
    }
}
