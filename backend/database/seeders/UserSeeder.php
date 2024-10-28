<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

//追加 2024/10/21 管理者とゲストのURLを分ける
//userのseeder作成。

//seederの実行。
//php artisan db:seed --class=UserSeeder

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Admin',
            // 任意のメールアドレス
            'email' => 'jsys.iwatsubo21120053@gmail.com', 
            // ハッシュ化したパスワード
            'password' => Hash::make('pass0210'), 
            // 'password' => 'pass0210',
        ]);
    }
}
