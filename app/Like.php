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
}