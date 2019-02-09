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
                            <img src="data:image/png;base64,{{ $post['image'] }}" alt="image">
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