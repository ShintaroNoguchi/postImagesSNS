<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Post;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'post') {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Post::$rules;
    }

    public function messages() {
        return [
            'image.required' => '画像を選択してください。',
            'image.max' => 'ファイルサイズが60MB以下の画像をアップロード可能です。',
            'image.mimetypes' => '以下の形式の画像がアップロード可能です。：jpg, png, gif',
            'comment.max' => 'コメントは200文字まで入力可能です。',
        ];
    }
}
