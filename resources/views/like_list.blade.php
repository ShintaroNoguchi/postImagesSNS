@extends ('layouts.base')

@section ('css')
    <link href="" rel="stylesheet" type="text/css">
@endsection

@section ('content')
    @if(count($likes) > 0)
        <table id="list">
            <tbody>
                @foreach ($likes as $like)
                    <tr><td><a href="/profile?id={{ $like->getId() }}"><img src="{{ $like->getAvatarUrl() }}" alt="User Icon"></a></td><td><a href="/profile?id={{ $like->getId() }}">{{ $like->getName() }}</a></td></tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>表示できるユーザがいません</p>
    @endif
@endsection