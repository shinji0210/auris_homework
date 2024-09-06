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
            //タグ1～10
            $table->string('tag_01',10);
            $table->string('tag_02',10);
            $table->string('tag_03',10);
            $table->string('tag_04',10);
            $table->string('tag_05',10);
            $table->string('tag_06',10);
            $table->string('tag_07',10);
            $table->string('tag_08',10);
            $table->string('tag_09',10);
            $table->string('tag_10',10);
            //デフォルトでfalse。削除した際はtrueに変更し、画面に表示させない。
            $table->boolean('status')->default(false);
            //投稿日時
            $table->timestamp('post_created_at')->useCurrent()->nullable();
            //更新日時　編集された時、削除状況が変わった時に更新
            $table->timestamp('post_updated_at')->useCurrent()->nullable();

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
