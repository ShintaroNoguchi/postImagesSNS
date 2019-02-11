<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $param = [
            'name' => 'YamadaTaro',
            'avatar_url' => 'https://avatars2.githubusercontent.com/u/40059723?v=4',
            'github_id' => 'YamadaTaro',
            'email' => 'xxx@xx.ne.jp',
            'password' => 'xxxxx',
            'remember_token' => 'xxxxx',
        ];
        $user->fill($param)->save();

        $user = new User;
        $param = [
            'name' => 'TanakaHanako',
            'avatar_url' => 'https://avatars2.githubusercontent.com/u/40059723?v=4',
            'github_id' => 'TanakaHanako',
            'email' => 'yyy@xx.ne.jp',
            'password' => 'xxxxx',
            'remember_token' => 'yyyyy',
        ];
        $user->fill($param)->save();
    }
}
