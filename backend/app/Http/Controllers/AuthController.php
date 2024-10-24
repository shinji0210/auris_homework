<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

//追加 2024/10/21 管理者とゲストのURLを分ける
//パスワードの確認とリダイレクトを行うコントローラーを作成

class AuthController extends Controller
{
    //ログイン処理
    public function login(Request $request){
        
        //admin下にいけるようパスワードを設定
        //UserSeederでも設定している。
        $correctPassword = 'pass0210';

        $request->validate([
            'password' => 'required',
        ], [
            'password.required' => '管理者でログインする場合、パスワードは必須です',
        ]);

        // 入力されたパスワードを確認
        if ($request->password === $correctPassword) {

            // ユーザーを認証し、セッションに保持
            // id:1には管理者の情報が入っている。
            //loginUsingId($id, $remember = false(デフォルト))：ユーザーのIDと
            //「Remember 」のオプション。true にすると、ユーザーが次回から自動的にログインされるようにクッキーが作成される。
            //ユーザーがアプリケーションから自分でログアウトするまで認証され続ける。
            auth()->loginUsingId(1, true);

            // 管理者ページにリダイレクト
            return redirect()->route('admin.index');
        } else {
            // パスワードが間違っている場合、エラーメッセージと共にログインページへリダイレクト
            return back()->withErrors(['password' => 'パスワードが正しくありません']);
        }
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        auth()->logout(); 
        // セッションの削除
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
