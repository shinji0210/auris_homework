<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyProfile;
use App\Models\MyProfilePostTags;
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
        //変更 2024/10/9 タグ可変式に伴う変更
        //post_status=0、post_noを降順にして取得。
        $posts = MyProfile::where('post_status', '0')
        ->orderby('post_no', 'desc')
        //変更 2024/10/8 タグは可変式で登録
        //with句を用いてタグ内容を結び付けて取得するようにする
        ->with('tags')
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
        //status=false、post_noを降順にして取得。
        $posts = MyProfile::where('status', false)
        ->orderby('post_no', 'desc')
        //変更 2024/10/8 タグは可変式で登録
        //with句を用いてタグ内容を結び付けて取得するようにする
        ->with('tags')
        ->get();

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


        // タグの登録（空でないタグのみ）
        // array_filter() を使って入力欄が空のタグを除外
        $tags = array_filter($request->tags); 

        // データベースに登録
        DB::table('myprofile_posts')->insert([
            'post_no' => $postNo,
            'name' => $request->input('name'),
            'post_content' => $request->input('content'),
            //タグの設定数
            'post_tags_count' => count($tags),
            // 投稿ステータス。初期値は0
            'post_status' => '0',
            'status' => false,// 初期状態はfalse
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        

        // foreachでループして登録
        foreach ($tags as $tag_content) {
            $maxTagNo = DB::table('myprofile_posts_tags')->max('tag_no');
            $tagNo = $maxTagNo ? $maxTagNo + 1 : 1;
            DB::table('myprofile_posts_tags')->insert([
                'tag_no' => $tagNo,
                'post_no' => $postNo,
                'tag_content' => $tag_content,
                'status' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 「投稿しました」メッセージをセッションに追加
        return redirect()->route('index')->with('message', '投稿しました。');
    }

    //投稿を更新する時に使う
    public function post_update(Request $request){

        
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
        
        // 変更 2024/10/9 タグは可変式で登録
        //タグのリスト
        $tags = $request->input('tags');

        //myprofile_posts テーブルの更新
        $updated = MyProfile::where('post_no', $request->input('post_no'))->update([
            'name' => $request->input('name'),
            'post_content' => $request->input('content'),
            //タグの設定数
            'post_tags_count' => count($tags),
            'updated_at' => now(),
        ]);

        //投稿Noに基づくタグの削除
        MyProfilePostTags::where('post_no', $request->input('post_no'))->delete();

        //myprofile_posts_tagsテーブル内のすべてのtag_noを配列として取得
        $existingTagNos = MyProfilePostTags::pluck('tag_no')->toArray();

        
        //投稿No
        $post_no = $request->input('post_no');

        //タグが空でない場合、myprofile_posts_tagsにタグ追加処理を行う
        if (!empty($tags)) {
            $nextTagNo = 1;  // タグ番号を1から開始
            foreach ($tags as $tag_content) {
                //リスト内で、空の入力欄タグがあれば無視する
                if (!empty($tag_content)) {
                    //既存のtag_noと重複しない番号を探す。
                    // 重複していた場合、nextTagNoを+1して、重複がなくなるまで確認。
                    while (in_array($nextTagNo, $existingTagNos)) {
                        $nextTagNo++;
                    }

                    // myprofile_posts_tags テーブルへの挿入
                    MyProfilePostTags::create([
                        'tag_no' => $nextTagNo,
                        'post_no' => $post_no,
                        'tag_content' => $tag_content,
                        'status' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    //新しく使ったtag_noを配列に追加して、次のループで重複が起きないようにする。
                    $existingTagNos[] = $nextTagNo;
                }
            }
        }

        

        // 「更新しました」メッセージをセッションに追加
        if ($updated) {
            return redirect()->route('post_manage')->with('message', '投稿が更新されました。');
        } else {
            return redirect()->route('post_manage')->with('message', '更新に失敗しました。');
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
        session([
            'post_no' => $request->input('post_no'),
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'tags' => $request->input('tags', []),
        ]);

        // リクエストで渡されたデータをビューに渡す
        return view('MyProfile.post_form_edit', [
            'post_no' => $request->input('post_no'),
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'tags' => $request->input('tags')
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
            //一括表示（post_statusをfalseにする）
            //post_noがpostNosに含まれる投稿を一括更新
            MyProfile::whereIn('post_no', $postNos)
            ->update(['post_status' => "0"]);
        }else{
            //一括非表示（post_statusをtrueにする）
            MyProfile::whereIn('post_no', $postNos)
            ->update(['post_status' => "1"]);
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
