<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Taskモデルを読み込み
use App\Models\Task;
//必須チェックを読み込み
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource. GET,HEADリクエストが送られた時に実行。
     */
    public function index()
    {
        //モデル名::all();でモデルのレコードを全部取得。
        //これを変数tasksに入れ、ビューファイルに、「tasks」という変数名で渡す。
        //＄tasks = Task::all();


        //変数 = モデルクラス::where(カラム名, 値)->get(); // 複数のレコードを取得するとき
        //変数 = モデルクラス::where(カラム名, 値)->first(); // 最初のレコードだけ取得するとき

        //statusがfalse(つまり0)のレコードだけ取得され、表示される
        $tasks = Task::where('status', false)->get();

        //compactを使うときのポイントは、変数名から＄マークを削除した文字列を引数として指定すること。
        //「/tasks」にアクセスがあったら、tasks/index.blade.phpの中身が表示される
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage. POSTリクエストが送られた時に実行。
     */
    public function store(Request $request)
    {

        //依存性の注入
        //あるクラスが依存している別のオブジェクトを外部から渡すことで、クラス間の依存度を下げる設計パターン
        
        //task_nameに、必須(required)と、100文字以下(max:100)をバリデーションルールとして設定。
        //バリデーションルールを複数設定したい場合は、パイプ|でつなぐ
        $rules = [
            'task_name' => 'required|max:100',
        ];
         
        //バリデーションのエラーメッセージ
        //形式： [バリデーションルールの名前=>エラーメッセージ]
        $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];
         
        //validateメソッドを呼び出すことで、エラーがあったときは元の画面に戻るようにするので、
        //バリデーションに引っかかったときはそれ以降のDBへの保存処理は実行されない。
        Validator::make($request->all(), $rules, $messages)->validate();


        //モデルをインスタンス化
        $task = new Task;

        //$request->input('フォームのキーの名前')
        //と書くことで、フォームから送信されたデータのうち、特定のキーの値を取り出すことができる。
        //モデルのインスタンス($task)->カラム名 = 値
        $task->name = $request->input('task_name');

        //データベースに保存
        $task->save();

        // /tasksが再び表示されるように、redirectメソッドを使ってリダイレクト
        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //editメソッドが呼び出されるのは、GETで「/tasks/タスクのID/edit」というアクセスがあったとき
        //モデル名::find(整数);と書くことでidに一致するレコードを取得することができる。(idが主キーでないといけない。)
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage. PUTリクエストが送られた時に実行。
     */
    public function update(Request $request, string $id)
    {
        //「編集する」ボタンをおしたとき
        if ($request->status === null) {

            //バリデーションチェック
        $rules = [
            'task_name' => 'required|max:100',
        ];
            
        $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];
            
        Validator::make($request->all(), $rules, $messages)->validate();
            
            
        //該当のタスクを検索
        $task = Task::find($id);
            
        //モデル->カラム名 = 値 で、データを割り当てる
        $task->name = $request->input('task_name');
            
        //データベースに保存
        $task->save();

        } else {
            //「完了」ボタンを押したとき

            //該当のタスクを検索
            $task = Task::find($id);
                
            //モデル->カラム名 = 値 で、データを割り当てる
            $task->status = true; //true:完了、false:未完了
                
            //データベースに保存
            $task->save();
        }

        //リダイレクト
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //該当のレコードを、findで探し、deleteメソッドを呼び出すだけで削除ができる。
        Task::find($id)->delete();
  
        return redirect('/tasks');
    }
}
