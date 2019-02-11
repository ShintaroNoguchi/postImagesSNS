<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>SNS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet" type="text/css">
        <link href="/css/base.css" rel="stylesheet" type="text/css">
        @yield('css')
    </head>
    <body>
        <header id="header">
            <nav id="header_nav">
                <ul class="nav_list">
                    <li class="nav_item current"><a href="{{ url('/') }}">ホーム</a></li>
                    <li class="nav_item">
                        @if(Auth::check())
                            <a href="{{ url('/logout') }}">ログアウト</a>
                        @else
                            <a href="{{ url('/login') }}">ログイン</a>
                        @endif
                    </li>
                    <li class="nav_item"><a href="{{ url('/post') }}">投稿</a></li>
                </ul>
            </nav>
        </header>
        <div id="content">
            @yield('content')
        </div>
    </body>
</html>
