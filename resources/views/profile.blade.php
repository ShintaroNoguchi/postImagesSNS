@extends ('layouts.base')

@section ('content')
    <table id="userInfo">
        <tbody>
                <tr><td rowspan="2"><img src="{{ $avatar_url }}" alt="User Icon"></td><td>{{ $name }}</td></tr>
                <tr><td>{{ $num_of_likes }}</td></tr>
        </tbody>
    </table>
    <div id="images">
        @foreach ($posts as $post)
            <img src="data:image/png;base64,{{ $post['image'] }}" alt="image">
        @endforeach
    </div>
@endsection