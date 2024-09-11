<?php

use Illuminate\Support\Facades\Route;

//↓追記しておく
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TaskController;

//自己紹介ページ用
use App\Http\Controllers\MyProfileController;
use Illuminate\Http\Request;


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

//自己紹介ページ用
Route::get('MyProfile', [MyProfileController::class, 'index']);
Route::get('MyProfile', function () {
    return view('MyProfile.index');
})->name('index');
Route::get('MyProfile/self_introduction', function () {
    return view('MyProfile.self_introduction');
})->name('self_introduction');
Route::get('MyProfile/career', function () {
    return view('MyProfile.career');
})->name('career');
Route::get('MyProfile/want_to_do', function () {
    return view('MyProfile.want_to_do');
})->name('want_to_do');
Route::get('MyProfile/skill', function () {
    return view('MyProfile.skill');
})->name('skill');
Route::get('MyProfile/post_form', function () {
    return view('MyProfile.post_form');
})->name('post_form');

// 投稿データを保存するルート
Route::post('post', [MyProfileController::class, 'store']);

//index.blade.phpからcheck_password ルートに送信されたパスワードを受け取る
//correctPasswordの値と一致するか検証。
//Route::post～：POSTリクエストに応答するルートを設定
//name('check_password')：このルートに名前を付与
Route::post('/check-password', function (Request $request) {
    //正しいパスワードを設定
    $correctPassword = 'shinji0120';

    if ($request->password === $correctPassword) {
        // 認証成功: セッションにフラグを設定
        //ページ遷移を試みるたびにパスワードの入力を求める
        //必要なルート：middleware、get'/login' get '/logout'
        session(['authenticated' => true]);
        //認証が成功した場合、post_manageに移行
        return redirect()->route('post_manage');
    } else {
        // エラーメッセージをセッションに保存してリダイレクト
        return redirect()->back()->with('error', 'パスワードが違います。');
    }
    //
})->name('check_password');

Route::get('/post-manage', function () {
    return view('MyProfile.post_manage');
})->name('post_manage');


// Route::get('/', function () {
//     return view('welcome');
// });
