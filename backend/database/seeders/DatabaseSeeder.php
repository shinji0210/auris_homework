<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //作成したTodoListSeederクラスを呼び出すように設定。
        $this->call([
            TodoListSeeder::class
          ]);

        // MyProfileSeederを呼び出す
        //10/18 追加 MyProfileのfactoryとseeder作成
        $this->call(MyProfileSeeder::class);

        //追加 2024/10/21 管理者とゲストのURLを分ける
        //userのseederを呼び出す。
        $this->call(UserSeeder::class);
    }
}
