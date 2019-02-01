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
        'image' => 'required|max:60000|mimetypes:image/gif,image/jpeg,image/png'
    );

    //投稿削除時のバリデーション
    public static $delete_rules = array(
        'id' => 'required|integer|min:0'
    );


    //主テーブル(usersテーブル)とbelongsTo結合
    public function user() {
        return $this->belongsTo('App\User');
    }

    //従テーブル(favoritesテーブル)とhasMany結合
    public function favorites() {
        return $this->hasMany('App\Favorite');
    }

    //Userからnameを取得
    public function getName() {
        return $this->user->name;
    }

    //ログインしているユーザがその投稿に対していいねしたかチェックする関数
    //既にいいねした場合はtrueを、まだの場合はfalseを返す
    public function isLiked() {
        $ownFavorite = 0;

        foreach ($this->favorites as $obj) {
            if ($obj['user_id'] == $this->user_id) {
                $ownFavorite = 1;
                break;
            }
        }

        if ($ownFavorite == 1) return true;
        else return false;
    }

}
