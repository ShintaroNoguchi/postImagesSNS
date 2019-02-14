@extends ('layouts.base')

@section ('css')
    <link href="/css/profile.css" rel="stylesheet" type="text/css">
@endsection

@section ('content')
    <div class="profile">
        <div class="profileContainer">
            <table id="userInfo">
                <tbody>
                        <tr><td rowspan="2" class="left"><img class="userIcon" src="{{ $avatar_url }}" alt="User Icon"></td><td class="right name">{{ $name }}</td></tr>
                        <tr><td class="right numOfLikes">いいねの数：{{ $num_of_likes }}</td></tr>
                </tbody>
            </table>
            <ul id="images">
                @foreach ($posts as $post)
                    <li>
                        <div class="image">
                            <a href="/show?id={{ $post->id }}" target="_blank">
                                @if (strpos($post->file_type, 'image') !== false)
                                    <img src="data:{{ $post['file_type'] }};base64,{{ $post['thumbnail'] }}" alt="image">
                                @else
                                    <video src="data:{{ $post['file_type'] }};base64,{{ $post['thumbnail'] }}"></video>
                                @endif
                            </a>
                        </div>
                    </li>
                    @if ($loop->last)
                        @for ($i = 0; $i < 2 - ($loop->index % 3); $i++)
                            <li><div class="image dummy"></div></li>
                        @endfor
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endsection