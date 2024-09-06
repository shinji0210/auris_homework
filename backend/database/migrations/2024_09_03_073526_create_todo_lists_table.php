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
        //テーブルの作成
        //backendに移り、php artisan make:model TodoList -mcを実行することでこのファイルが生成。

        Schema::create('todo_lists', function (Blueprint $table) {
            $table->id();
            //2024/9/3追記
            $table->string('name', 100); 
            //created_atとupdated_atの2つのカラムを追加する機能を持つ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo_lists');
    }
};
