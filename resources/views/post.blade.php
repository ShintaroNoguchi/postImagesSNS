@extends('layouts.base')

@section('content')
    @if (count($errors) > 0)
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <table>
        <tbody>
            <form action="/post" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <tr><td><input type="file" class="form-control" name="image"></td></tr>
                <tr><td><textarea name="comment">{{ old('comment') }}</textarea></td></tr>
                <tr><td><input type="submit" value="投稿"></td></tr>
            </form>
        </tbody>
    </table>
@endsection