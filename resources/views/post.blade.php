@extends('layouts.base')

@section('css')
    <link href="/css/post.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="form">
        <div class="formContainer">
            <form action="/post" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="inputContainer first">
                    <p class="title">画像(jpg, png, gif)・動画(mp4)</p>
                    @if ($errors->has('image'))
                        <p class="error">{{ $errors->first('image') }}</p>
                    @endif
                    <input type="file" class="form-control file" name="image">
                </div>
                <div class="inputContainer">
                    <p class="title">コメント(200字まで)</p>
                    @if ($errors->has('comment'))
                        <p class="error">{{ $errors->first('comment') }}</p>
                    @endif
                    <textarea class="comment" name="comment">{{ old('comment') }}</textarea>
                </div>
                <div class="inputContainer">
                    <input type="submit" class="submitBtn" value="投稿">
                </div>
            </form>
        </div>
    </div>
@endsection