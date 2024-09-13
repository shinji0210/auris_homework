<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyProfile;
use App\Http\Requests\MyProfilePostValidate;
use Illuminate\Support\Facades\DB;

class MyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //全投稿を取得
        //status=false、post_noを降順にして取得。
        $posts = MyProfile::where('status', false)
        ->orderby('post_no', 'desc')
        ->get();

        //自己紹介ページ表示(ホーム)
        return view('MyProfile.index', compact('posts'));
    }

    public function create(){
        
        return view('MyProfile.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function self_introduction()
    {
        //自身の自己紹介ページ
        return view('MyProfile.self_introduction');
    }

    public function career()
    {
        //自身の経歴ページ
        return view('MyProfile.career');
    }

    public function want_to_do()
    {
        //自身のやりたいことページ
        return view('MyProfile.want_to_do');
    }

    public function skill()
    {
        //自身の特技ページ
        return view('MyProfile.skill');
    }

    public function post_manage()
    {
        //全投稿を取得
        $posts = MyProfile::orderby('post_no', 'desc')->get();

        //自己紹介ページ表示(ホーム)
        return view('MyProfile.post_manage', compact('posts'));
    }
    


    /**
     * Store a newly created resource in storage.
     * 作成処理に使う
     */
    public function store(Request $request)
    {
        //データの検証
        //問題なければvalidatedに格納される。
        $validated = $request->validate([
            'name' => 'required|max:40',
            'content' => 'required|max:200',
        ],
        [
            'name.required' => '※名前を入力してください。',
            'content.required' => '※投稿内容を入力してください。'
        ]);

        // post_noの生成（最大値取得 + 1）
        $maxPostNo = DB::table('myprofile_posts')->max('post_no');
        $postNo = $maxPostNo ? $maxPostNo + 1 : 1;

        // データベースに登録
        DB::table('myprofile_posts')->insert([
            'post_no' => $postNo,
            'name' => $request->input('name'),
            'post_content' => $request->input('content'),
            'tag_01' => $request->input('tag_01') ?? null,
            'tag_02' => $request->input('tag_02') ?? null,
            'tag_03' => $request->input('tag_03') ?? null,
            'tag_04' => $request->input('tag_04') ?? null,
            'tag_05' => $request->input('tag_05') ?? null,
            'tag_06' => $request->input('tag_06') ?? null,
            'tag_07' => $request->input('tag_07') ?? null,
            'tag_08' => $request->input('tag_08') ?? null,
            'tag_09' => $request->input('tag_09') ?? null,
            'tag_10' => $request->input('tag_10') ?? null,
            'status' => false,// 初期状態はfalse
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // 「投稿しました」メッセージをセッションに追加
        return redirect()->route('post_form')->with('message', '投稿しました。');
    }

    //投稿を更新する時に使う
    public function post_update(Request $request){

        //配列に変換
        $postNos = is_array($request->input('post_no')) ? $request->input('post_no') : [$request->input('post_no')];

        //データの検証
        //問題なければvalidatedに格納される。
        $validated = $request->validate([
            'name' => 'required|max:40',
            'content' => 'required|max:200',
        ],
        [
            'name.required' => '※名前を入力してください。',
            'content.required' => '※投稿内容を入力してください。'
        ]);
        
        $updated = MyProfile::whereIn('post_no', $postNos)->update([
            'name' => $request->input('name'),
            'post_content' => $request->input('content'),
            'tag_01' => $request->input('tag_01'),
            'tag_02' => $request->input('tag_02'),
            'tag_03' => $request->input('tag_03'),
            'tag_04' => $request->input('tag_04'),
            'tag_05' => $request->input('tag_05'),
            'tag_06' => $request->input('tag_06'),
            'tag_07' => $request->input('tag_07'),
            'tag_08' => $request->input('tag_08'),
            'tag_09' => $request->input('tag_09'),
            'tag_10' => $request->input('tag_10'),
            'updated_at'=> now()
        ]);
        

        // 「更新しました」メッセージをセッションに追加
        if ($updated) {
            return redirect()->route('post_form_edit')->with('message', '投稿が更新されました。');
        } else {
            return redirect()->route('post_form_edit')->with('message', '更新に失敗しました。');
        }
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
     * 編集処理に使う
     */
    public function edit(Request $request)
    {
        // リクエストで渡されたデータをビューに渡す
            return view('MyProfile/post_form_edit', [
                'name' => $request->input('name'),
                'content' => $request->input('content'),
                'tags' => [
                    $request->input('tag_01'),
                    $request->input('tag_02'),
                    $request->input('tag_03'),
                    $request->input('tag_04'),
                    $request->input('tag_05'),
                    $request->input('tag_06'),
                    $request->input('tag_07'),
                    $request->input('tag_08'),
                    $request->input('tag_09'),
                    $request->input('tag_10'),
                ],
            ]);
    }

    /**
     * Update the specified resource in storage.
     * 更新処理に使う
     */
    public function update(Request $request)
    {
        $postNos = $request->input('postNos');
        $action = $request->input('action');

        //actionにunhideが送られてきた場合は表示処理を行う
        if ($action === 'unhide') {
            //一括表示（statusをfalseにする）
            //post_noがpostNosに含まれる投稿を一括更新
            MyProfile::whereIn('post_no', $postNos)
            ->update(['status' => 0]);
        }else{
            //一括非表示（statusをtrueにする）
            MyProfile::whereIn('post_no', $postNos)
            ->update(['status' => 1]);
        }
        
        //元の画面にtrueのレスポンスを送る。
        return response()->json(['success' => true]);
    }

    //削除処理
    public function delete(Request $request){
        $postNos = $request->input('postNos');

        //whereInで絞ったデータを削除
        MyProfile::whereIn('post_no', $postNos)
        ->delete();

        //元の画面にtrueのレスポンスを送る。
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
