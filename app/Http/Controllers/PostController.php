<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;

use App\Video;
use Carbon\Carbon;
use FFMpeg;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class PostController extends Controller
{
    //投稿画面表示
    public function index()
    {
        return view('post');
    }

    //投稿処理
    public  function post(PostRequest $request)
    {
        //サムネイル画像作成のためのリサイズ処理
        if (strpos($request->image->getMimeType(), 'image') !== false) {
            list($originalWidth, $originalHeight) = getimagesize($request->image->getRealPath());

            if ($originalWidth > 700) {
                //元画像の幅がサムネイル画像の最大幅(700px)より大きい場合のみリサイズ
                list($canvasWidth, $canvasHeight) = $this->get_contain_size($originalWidth, $originalHeight);
                $thumb_binary = $this->transform_image_size($request->image->getRealPath(), $canvasWidth, $canvasHeight);
            }
            else {
                //サムネイル画像は元画像をそのまま使う
                $thumb_binary = file_get_contents($request->image->getRealPath());
            }
        }
        else {
            $media = open($request->image->getRealPath());
            //$thumb_binary = $media->getFrameFromString('00:00:00.00');

            $thumb_binary = file_get_contents($request->image->getRealPath()); //仮
        }

        //DBに投稿を保存
        $post = new Post;
        $post->user_id = $request->user_id;
        $post->comment = $request->comment;
        $post->file_type = $request->image->getMimeType();
        $post->image = base64_encode(file_get_contents($request->image->getRealPath())); //元画像を保存
        $post->thumbnail = base64_encode($thumb_binary); //サムネイル画像を保存
        $post->save();

        return redirect('/');
    }


    //アスペクト比の計算をする関数
    private function get_contain_size($width, $height) {
        $ratio = $height / $width;

        return [700, intval(700*$ratio)];
    }

    //リサイズをする関数
    private function transform_image_size($srcPath, $width, $height) {
        //画像を読込み
        list($originalWidth, $originalHeight, $type) = getimagesize($srcPath);
        switch ($type) {
            case IMAGETYPE_JPEG:
                $source = imagecreatefromjpeg($srcPath);
                break;
            case IMAGETYPE_PNG:
                $source = imagecreatefrompng($srcPath);
                break;
            case IMAGETYPE_GIF:
                $source = imagecreatefromgif($srcPath);
                break;
        }

        //リサイズ
        $canvas = imagecreatetruecolor($width, $height);
        imagecopyresampled($canvas, $source, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);

        //画像をバイナリデータとして保存
        ob_start();
        imagejpeg($canvas, null);
        $image_binary = ob_get_clean();

        imagedestroy($source);
        imagedestroy($canvas);

        return $image_binary;
    }

}
