<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>

        </style>
    </head>
    <body>
        <header>
            <table>
                <tr>
                @if(Auth::check())
                <td>ホーム</td><td>ログアウト</td><td>投稿</td>
                @else
                <td>ホーム</td><td>ログイン</td><td>投稿</td>
                @endif
                </tr>
            </table>
        </header>
        @yield('content')
    </body>
</html>
