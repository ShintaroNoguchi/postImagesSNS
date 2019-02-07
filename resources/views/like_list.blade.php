@extends ('layouts.base')

@section ('css')
    <link href="" rel="stylesheet" type="text/css">
@endsection

@section ('content')
    <table id="list">
        <tbody>
            @foreach ($likes as $like)
                <tr><td><a href="/profile?id={{ $like->getId() }}"><img src="{{ $like->getAvatarUrl() }}" alt="User Icon"></a></td><td><a href="/profile?id={{ $like->getId() }}">{{ $like->getName() }}</a></td></tr>
            @endforeach
        </tbody>
    </table>
@endsection