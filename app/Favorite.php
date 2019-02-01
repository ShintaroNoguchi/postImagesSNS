<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $guarded = array('id');


    //いいね時のバリデーション
    public static $rules = array(
        'user_id' => 'required|integer|min:0',
        'post_id' => 'required|integer|min:0',
    );
}
