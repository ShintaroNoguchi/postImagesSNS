@extends('layouts.base')

@section('content')
    @if(count($posts) > 0)
        @foreach ($posts as $post)
            <div class="postContainer">
                <table>
                    <tbody>
                        <tr>
                            <td><span>{{ $post->getName() }}</span></td>
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
                                        いいねした
                                    @else
                                        いいねしてない
                                    @endif
                                @else
                                    ★(未ログイン)
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