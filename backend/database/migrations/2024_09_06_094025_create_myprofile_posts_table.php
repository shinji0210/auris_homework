<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('myprofile_posts', function (Blueprint $table) {

            //投稿No
            $table->id('post_no');
            //名前(40文字以内)
            $table->string('name', 40);
            //投稿内容(200文字以内)
            $table->string('post_content', 200);
            //投稿についてくるタグ数
            $table->integer('post_tags_count');
            //投稿ステータス(削除状態：-1、表示状態：0、非表示状態：1)
            $table->string('post_status', 1);
            //デフォルトでfalse。削除した際はtrueに変更し、画面に表示させない。
            $table->boolean('status')->default(false);
            // 他のカラム
            //投稿日時、更新日時　編集された時、削除状況が変わった時に更新
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('myprofile_posts');
    }
};
