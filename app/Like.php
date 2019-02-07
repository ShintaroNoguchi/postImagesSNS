<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = array('id');

    //いいね時のバリデーション
    public static $rules = array(
        'post_id' => 'required|integer|min:0',
    );


    //主テーブル(usersテーブル)とbelongsTo結合
    public function user() {
        return $this->belongsTo('App\User');
    }


    //いいねしたユーザの情報を取得
    public function getId() {
        return $this->user->id;
    }
    public function getName() {
        return $this->user->name;
    }
    public function getAvatarUrl() {
        return $this->user->avatar_url;
    }
}