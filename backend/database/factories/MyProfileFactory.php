<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MyProfile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MyProfile>
 */

//10/18 追加 MyProfileのfactoryとseeder作成

//Factoryは、モデルのサンプルデータを生成するために使用される。
//ランダムなデータを手軽に生成できるので、データベースのテーブルに大量のテストデータを簡単に挿入できる。


//以下のコマンドでfactoryを作成。
//php artisan make:factory MyProfileFactory --model=MyProfile



class MyProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = MyProfile::class;
    
    public function definition(): array
    {
        // Fakerで日本語の名前や文章を生成する
        // config/app.phpにて‘faker_locale’ => ‘ja_JP’,に修正


        //myprofile_postsにランダムなデータを生成
        return [
            //名前
            'name' => $this->faker->name,
            //メソッドを使用する場合
            // 'name' => $this->generateJapaneseName(),

            //投稿内容
            //fakerでランダム生成する場合。
            // 'post_content' => $this->faker->text(200),
            'post_content' => $this->generateJapaneseContent(),
            
            // タグの数をランダムに設定
            'post_tags_count' => rand(1, 5), 
            // デフォルトは表示状態
            'post_status' => '0',
            //表示、非表示、削除状態をランダムで生成する場合
            // 'post_status' => $this->faker->randomElement(['0', '1', '9']), 
            //デフォルトでfalse
            'status' => false, 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * 日本語の名前を生成するメソッド
     */
    private function generateJapaneseName(): string
    {
        $names = ['田中', '山田', '佐藤', '鈴木', '高橋', '伊藤', '渡辺', '中村', '小林', '加藤'];
        //名前の後ろに「さん」を付けて返す
        return $names[array_rand($names)] . 'さん';
    }

    /**
     * 日本語の投稿内容を生成するメソッド
     */
    private function generateJapaneseContent(): string
    {
        $contents = [
            '今日はいい天気です。',
            '新しいプロジェクトが始まりました。',
            '最近読んだ本はとても面白かったです。',
            '旅行に行きたいです。',
            '新しい趣味を始めました。'
        ];
        //自動生成されたことが分かるように、名前の後ろに「(自動生成)」を付けて返す
        return $contents[array_rand($contents)] . '(自動生成)';
    }


     /**
     * ランダムな10文字以内のタグを生成するメソッド
     */
    private function generateTagContent(): string
    {
        $tagList = [
            '旅行', '読書', '料理', '運動', '映画', '音楽', 'アート', 'スポーツ', '勉強', 'ゲーム',
            'プログラミング', '散歩', '自然', '写真', '自転車', '釣り', 'カフェ', 'お茶', 'お菓子', '犬'
        ];

        return $tagList[array_rand($tagList)];

        //fakerで生成する場合。
        //rand(1, 10): 1から10までのランダムな数を取得
        //str_repeat('?', rand(1, 10)): そのランダムな数に応じて、クエスチョンマークを繰り返す文字列を作成
        //lexify(): 生成したクエスチョンマークの文字列内の?をランダムな英字（a～z）に置き換える
        // return $this->faker->lexify(str_repeat('?', rand(1, 10)));
    }
}
