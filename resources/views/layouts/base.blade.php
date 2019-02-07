<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>SNS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet" type="text/css">
        @yield('css')

        <!-- Styles -->
        <style>

        </style>
    </head>
    <body>
        <header>
            <table>
                <tbody>
                    <tr>
                        <td><a href="{{ url('/') }}">ホーム</a></td>
                        <td>
                            @if(Auth::check())
                            <a href="{{ url('/logout') }}">ログアウト</a>
                            @else
                            <a href="{{ url('/login') }}">ログイン</a>
                            @endif
                        </td>
                        <td><a href="{{ url('/post') }}">投稿</a></td>
                    </tr>
                </tbody>
            </table>
        </header>
        @yield('content')
    </body>
</html>
