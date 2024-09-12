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
        $posts = MyProfile::orderby('post_no', 'desc')->get();

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


    


    /**
     * Store a newly created resource in storage.
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
            'status' => false, // 初期状態はfalse
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // 「投稿しました」メッセージをセッションに追加
        return redirect()->route('post_form')->with('message', '投稿しました。');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
