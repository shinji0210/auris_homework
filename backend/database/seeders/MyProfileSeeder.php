<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MyProfile;
use App\Models\MyProfilePostTags;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

//10/18 追加 MyProfileのfactoryとseeder作成

//Factoryで作成されたデータをデータベースに実際に挿入する。
//DatabaseSeederからこのMyProfileSeederを呼び出す。

//以下のコマンドでseederを作成。
//php artisan make:seeder MyProfileSeeder

//以下のコマンドで20 件の投稿とそれに関連するタグが 1～5 個ずつ作成される。
//php artisan db:seed --class=MyProfileSeeder

class MyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    
    public function run(): void
    {
        // post_no の最大値を取得し、その値に +1 をしたものを基準に投稿を作成
        $maxPostNo = DB::table('myprofile_posts')->max('post_no') ?? 0;
        $postNo = $maxPostNo + 1;

        // 1. 20個の投稿をFactoryを使って作成し、そのpost_noと投稿数に基づくタグを生成
        $posts = MyProfile::factory(20)->make()->each(function ($post) use (&$postNo) {
            // 各投稿に対してpost_noを設定し、保存するための準備
            $post->post_no = $postNo++;
            $post->save();
        });

        // 2. タグデータの準備
        $maxTagNo = DB::table('myprofile_posts_tags')->max('tag_no') ?? 0;
        $tagNo = $maxTagNo + 1;

        // タグ生成
        foreach ($posts as $post) {
            $postTagCount = $post->post_tags_count;  // 各投稿のタグ数を取得

            // タグデータをFactoryを利用して生成し、各投稿に紐付ける
            MyProfilePostTags::factory($postTagCount)->make()->each(function ($tag) use ($post, &$tagNo) {
                // 各タグに対してtag_noとpost_noを設定
                $tag->tag_no = $tagNo++;
                $tag->post_no = $post->post_no;
                $tag->save(); // データベースに保存
            });
        }
    }
}
