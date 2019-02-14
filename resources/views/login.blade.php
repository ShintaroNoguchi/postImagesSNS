<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @if(Agent::isMobile())
            <meta name="viewport" content="width=750">
        @endif
        <title>SNS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet" type="text/css">
        <link href="/css/login.css" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>

        </style>
    </head>
    <body>
        <div id="content">
            <div class="loginContainer">
                <a class="loginBtn" href="/login/github">githubアカウントでログイン</a>
            </div>
        </div>
    </body>
</html>
