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
        // tagを管理するテーブル
        Schema::create('myprofile_posts_tags', function (Blueprint $table) {
            //タグid
            $table->id('tag_no');
            //
            $table->unsignedBigInteger('post_no');
            //タグ。nullを許容
            $table->string('tag_content', 10)->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();


            // 外部キー制約
            //・myprofile_posts_tags に新しいレコードを挿入する際に、post_no に存在しない
            //myprofile_posts.post_no の値が入ることを防ぐことができる。
            // ・onDelete('cascade') を追加することで、
            // myprofile_posts テーブルで特定の post_no に対応するレコードが削除された場合、
            // その post_no に関連するすべてのmyprofile_posts_tagsテーブルの
            // レコードも自動的に削除される
            $table->foreign('post_no')->references('post_no')->on('myprofile_posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('myprofile_posts_tags');
    }
};
