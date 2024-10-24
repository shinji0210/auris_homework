<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        //追加 2024/10/21 管理者とゲストのURLを分ける
        //未認証のユーザーがアクセスした際に login ページにリダイレクトされるタイミングで、
        //以下のようにセッションにアラート用メッセージを設定
        if (! $request->expectsJson()) {
            // セッションにアラートメッセージを保存
            session()->flash('alert', '管理者ページにアクセスするにはログインが必要です。');
            return route('login');
        }
    }
}
