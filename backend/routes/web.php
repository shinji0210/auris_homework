<?php

use Illuminate\Support\Facades\Route;

//↓追記しておく
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//ルーティングは以下のような形式で記述。
//Route::get( アドレス , [コントローラーの名前::class , メソッド名] );

//「/list」にGETリクエストがある。
//ルーティングで指定したコントローラーのメソッドが実行される
//データベースからモデルを通してデータを取得し、ビューに渡し、表示する
Route::get('/list', [TodoListController::class, 'index']);

//ToDoアプリ用
//TaskController.php内の各メソッドが使用できる
Route::resource('tasks', TaskController::class);

// Route::get('/', function () {
//     return view('welcome');
// });
