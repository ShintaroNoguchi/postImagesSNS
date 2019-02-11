@extends ('layouts.base')

@section ('css')
    <link href="/css/like_list.css" rel="stylesheet" type="text/css">
@endsection

@section ('content')
    @if(count($likes) > 0)
        <div class="likeList">
            <div class="likeListContainer">
                <table id="userInfo">
                    <tbody>
                        @foreach ($likes as $like)
                            <tr>
                                <td class="left"><a href="/profile?id={{ $like->getId() }}"><img class="userIcon" src="{{ $like->getAvatarUrl() }}" alt="User Icon"></a></td>
                                <td class="right name"><a href="/profile?id={{ $like->getId() }}">{{ $like->getName() }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p id="none">表示できるユーザがいません</p>
    @endif
@endsection