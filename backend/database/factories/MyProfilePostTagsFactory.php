<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MyProfilePostTags;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MyProfilePostTags>
 */

//10/18 追加 MyProfileのfactoryとseeder作成

//Factoryは、モデルのサンプルデータを生成するために使用される。
//ランダムなデータを手軽に生成できるので、データベースのテーブルに大量のテストデータを簡単に挿入できる。


//以下のコマンドでfactoryを作成。
//php artisan make:factory MyProfilePostTagsFactory --model=MyProfilePostTags

class MyProfilePostTagsFactory extends Factory
{

    protected $model = MyProfilePostTags::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //ランダムな 10 文字以内のタグを生成
            // 'tag_content' => $this->faker->lexify(str_repeat('?', 10)),
            'tag_content' => $this->generateTagContent(),
            // デフォルトでfalse
            'status' => false, 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * 日本語のタグを生成するメソッド
     */
    private function generateTagContent(): string
    {
        $tagList = [
            '旅行', '読書', '料理', '運動', '映画', '音楽', 'アート', 'スポーツ', '勉強', 'ゲーム',
            'プログラミング', '散歩', '自然', '写真', '自転車', '釣り', 'カフェ', 'お茶', 'お菓子', '犬'
        ];
        return $tagList[array_rand($tagList)];
    }
}
