@extends('layouts.base')

@section('css')
    <link href="/css/home.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    @if(count($posts) > 0)
        @foreach ($posts as $post)
            <div class="post">
                <div class="postContainer">
                    <div class="upperContainer">
                        <div class="nameContainer"><a class="name" href="/profile?id={{ $post->user_id }}" class="user_name">{{ $post->getName() }}</a></div>
                        @if(Auth::check())
                            <a class="deleteBtn" href="/delete?id={{ $post->id }}" class="delete_btn"><img class="trashIcon" src="/img/trash.png">投稿を削除</a>
                        @endif
                    </div>
                    <img class="image" src="data:image/png;base64,{{ $post->image }}">
                    <div class="lowerContainer">
                        <div class="comment">{{ $post->comment }}</div>
                        <div class="likeContainer">
                            <div>
                                @if(Auth::check())
                                    @if($post->isLiked())
                                        <form action="/dislike" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <input class="likeBtn" type="image" src="/img/likeButton/star_yellow.png" alt="いいねボタン">
                                        </form>
                                    @else
                                        <form action="/like" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <input class="likeBtn" type="image" src="/img/likeButton/star_gray.png" alt="いいね（未）ボタン">
                                        </form>
                                    @endif
                                @else
                                    <img class="likeBtn" src="/img/likeButton/star_nonActive.png">
                                @endif
                            </div>
                            <a class="likeListBtn" href="/like-list?id={{ $post->id }}" class="like_list">いいねしたユーザ</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}
    @else
        <p id="none">表示できる投稿がありません</p>
    @endif
@endsection