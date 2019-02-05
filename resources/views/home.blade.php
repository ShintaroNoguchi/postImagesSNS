@extends('layouts.base')

@section('content')
    @if(count($posts) > 0)
        @foreach ($posts as $post)
            <div class="postContainer">
                <table>
                    <tbody>
                        <tr>
                            <td><a href="/profile?id={{ $post->user_id }}" class="user_name">{{ $post->getName() }}</a></td>
                            <td>
                                @if(Auth::check())
                                    <a href="/delete?id={{ $post->id }}" class="delete_btn">投稿を削除</a>
                                @endif
                            </td>
                        </tr>
                        <tr><td><img src="data:image/png;base64,{{ $post->image }}"></td></tr>
                        <tr><td><span>{{ $post->comment }}</span></td></tr>
                        <tr>
                            <td>いいねしたユーザ</td>
                            <td>
                                @if(Auth::check())
                                    @if($post->isLiked())
                                        <form action="/dislike" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <input type="image" src="/img/likeButton/star_yellow.png" alt="いいねボタン">
                                        </form>
                                    @else
                                        <form action="/like" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <input type="image" src="/img/likeButton/star_gray.png" alt="いいね（未）ボタン">
                                        </form>
                                    @endif
                                @else
                                    <img src="/img/likeButton/star_nonActive.png">
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
        {{ $posts->links() }}
    @else
        <p>表示できる投稿がありません</p>
    @endif
@endsection