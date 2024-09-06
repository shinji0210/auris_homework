<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//↓追記しておく
use App\Models\TodoList;

class TodoListController extends Controller
{
    public function index(Request $request)
    {
        //データベースからテーブル「todo_lists」にある全レコードを取得
        //「TodoList」を使うためには、スクリプトの先頭でuse文によりTodoListを読み込まないといけない。
        $todo_lists = TodoList::all();
 
        //取得した値を変数「todo_lists」としてビューに渡す処理
        //第一引数：「どのビューファイルか」を指定。　書き方は、view(‘フォルダ名.ファイル名’)
        //変数名と値がペアになった連想配列を第2引数に設定。
        return view('todo_list.index', ['todo_lists' => $todo_lists]);
    }
}
