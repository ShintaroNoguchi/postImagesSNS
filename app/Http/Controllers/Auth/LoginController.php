<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ログイン画面を表示
     */
    public function index()
    {
        return view('login');
    }

    /**
     * GitHubの認証ページヘユーザーをリダイレクト
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->scopes(['read:user', 'public_repo'])->redirect();

        print('aaaa');
        exit();
    }

    /**
     * GitHubからユーザー情報を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        $github_user = Socialite::driver('github')->user();

        $now = date("Y/m/d H:i:s");
        $app_user = DB::select('select * from public.users where github_id = ?', [$github_user->user['login']]);
        if (empty($app_user)) {
            DB::insert('insert into public.users (name, avatar_url, github_id, email, password, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?)', [$github_user->nickname, $github_user->user['avatar_url'], $github_user->user['login'], $github_user->email, $github_user->user['node_id'], $now, $now]);
        }
        $request->session()->put('github_token', $github_user->token); //sessionにgithubのトークンを保存（不要？）

        //ログイン処理
        $user = User::firstOrCreate([
            'name' => $github_user->nickname,
            'avatar_url'   => $github_user->user['avatar_url'],
            'github_id'   => $github_user->user['login'],
            'email'    => $github_user->email,
        ]);
        Auth::login($user);

        return redirect('github');
    }
}
