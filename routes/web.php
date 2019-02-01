<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

//ログイン画面
Route::get('/login', 'Auth\LoginController@index')->name('login');;

//ソーシャルログイン関係
Route::get('github', 'Github\GithubController@top');
Route::post('github/issue', 'Github\GithubController@createIssue');
Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

//ログアウト
Route::get('/logout', 'Auth\LogoutController@index');

//ホーム画面
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/delete', 'HomeController@delete');

//投稿画面
Route::get('/post', 'PostController@index')->middleware('auth');
Route::post('/post', 'PostController@post')->middleware('auth');