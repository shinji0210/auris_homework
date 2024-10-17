

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>自己紹介ページ</title>
 
    <!-- ヘッダーフォント用 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-[100vh] bg-lime-100">
    <header class="bg-gradient-to-r from-blue-500 to-cyan-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-6">
                <p class="text-white text-3xl font-mochiy">投稿編集フォーム</p>
            </div>
        </div>
    </header>

    <div class="min-h-screen flex items-start justify-center p-6">
        <div class="text-left max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <!-- 中央、左寄せの文章 -->
            <p class="text-lg text-black mb-4">
                自己紹介ページのホームに載せる投稿を編集できます。<br>
                名前、投稿内容は必須入力です。<br>
                誹謗中傷に当たるような内容修正はご遠慮ください。
            </p>

            <!-- 名前、投稿内容が未入力だった場合に表示 -->
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <p class="text-red-500">
                                {{ $error }}
                            </p>
                        @endforeach
                    </ul>
                </div>
            @endif 
            

            <!-- 入力欄に管理画面から取得した値を設定 -->
            <form method="POST" action="/post_update">
                @csrf
                <!-- 名前ラベルと入力欄 -->
                
                <!-- 隠しフィールドでpost_noを確保 -->
                <input type="hidden" name="post_no" id="post_no" value="{{ request('post_no') }}">

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">名前　※40文字以内</label>
                    <input type="text" id="name" name="name" value="{{ request('name') }}" maxlength="40" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                
                <!-- 投稿内容ラベルと入力欄 -->
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">投稿内容　※200文字以内。</label>
                    <textarea id="content" name="content" maxlength="200" rows="4" class="w-full p-2 border border-gray-300 rounded-lg">{{ old('content', $content) }}</textarea>
                </div>

                    <!-- タグラベルと入力欄。10つまで設定可能 -->
                    <!-- 変更 2024/10/8 タグは可変式で登録 -->
                    <!-- こちらも管理画面から取得してくるが、nullの場合は空を設定 -->
                
                    <label for="tag" class="block text-sm font-medium text-gray-700 mb-1">タグ　※10文字以内。</label>


                <!-- タグ入力欄を配置するコンテナ -->
                <!-- flex-colを追加することで、縦方向にタグ入力欄が並ぶ -->
                <div id="tags-container" class="flex flex-col gap-2 mt-2">

                    @foreach($tags as $tag)
                        <!-- flexで入力欄と削除ボタンを横に並べる -->
                        <!-- タグ一つの時は削除ボタンを表示しない -->
                        <div class="tag-item flex items-center">
                            <input type="text" name="tags[]" value="{{ $tag }}" maxlength="10" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="タグ">
                            <button type="button" class="ml-2 p-2 bg-red-500 text-white rounded-lg" onclick="removeTag(this)">×</button>
                        </div>
                    @endforeach
                    
                </div>
                
                <!-- タグ追加ボタン -->
                <!-- クリック時にaddTag()メソッド実行 -->
                <button type="button" class="mt-4 p-2 bg-orange-600 text-white rounded-lg hover:bg-orange-800" onclick="addTag()">タグ追加</button>

                <!-- 更新ボタン -->
                <div class="mt-0 text-right">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        更新
                    </button>
                </div>
            </form>

            <!-- ホームに戻るリンク -->
            <div class="mt-2">
                <a href="{{ route('index') }}" id="home-link" class="inline-block px-6 py-1 bg-blue-600 text-white text-lg font-semibold rounded-md hover:bg-blue-700">
                    ホームに戻る
                </a>
            </div>
            <!-- スクリプト -->
            <script>

                // タグ入力欄を追加する関数
                function addTag() {
                    const container = document.getElementById('tags-container');
                    // タグ入力欄の数を取得して、1つ目のタグに「×」ボタンを追加するかどうかを判断
                    const tagCount = container.children.length;

                    // 新しいタグ入力欄のためのdiv要素を作成
                    const newTag = document.createElement('div');
                    newTag.classList.add('tag-item', 'flex', 'items-center');
                    // ここで作成する新しいタグ欄の×ボタンには、
                    // クリックするとremoveTag(this)関数が呼び出され、対応するタグ欄が削除される
                    newTag.innerHTML = `
                        <input type="text" name="tags[]" maxlength="10" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="タグ">
                        <button type="button" class="ml-2 p-2 bg-red-500 text-white rounded-lg hover:bg-red-700" onclick="removeTag(this)">×</button>
                    `;

                    // 新しいタグをコンテナに追加
                    container.appendChild(newTag);

                    // 2つ目のタグが追加された時、最初のタグに×ボタンを追加（ただし、既存の内容を保持）
                    if (tagCount === 1) {
                        // 最初のタグ入力欄（<div>）を取得
                        const firstTag = container.firstElementChild;
                        // 最初のタグ欄に既に存在するボタン要素を探す
                        const existingButton = firstTag.querySelector('button');
                        
                        // 既に×ボタンがない場合のみ、×ボタンを追加
                        if (!existingButton) {
                            // 削除ボタン（×ボタン）を新たに作成し、
                            // appendChildを使って最初のタグ欄に追加
                            const removeButton = document.createElement('button');
                            // 通常のボタン
                            removeButton.type = 'button';
                            // デザイン
                            //左側に2pxのmargin、paddingを2px、角丸、hover時の設定
                            removeButton.classList.add('ml-2', 'p-2', 'bg-red-500', 'text-white', 'rounded-lg', 'hover:bg-red-700');
                            removeButton.textContent = '×';
                            // タグ入力欄を削除する removeTag() 関数を付与
                            removeButton.onclick = function () {
                                removeTag(removeButton);
                            };
                            // firstTagには入力欄の要素が入っており、それに追加する形で×ボタンを追加
                            firstTag.appendChild(removeButton);
                        }
                    }
                }

                // タグ入力欄を削除する関数
                function removeTag(button) {
                    const container = document.getElementById('tags-container');
                    // 削除ボタンが押されたタグ欄（div）を取得
                    const tagItem = button.parentElement;
                    tagItem.remove();

                    // タグが1つしか残っていない場合、×ボタンを非表示にする
                    if (container.children.length === 1) {
                        const firstTag = container.firstElementChild;
                        // ボタンを非表示にする
                        const removeButton = firstTag.querySelector('button');
                        if (removeButton) removeButton.remove();
                    }
                }


                //ユーザーがホームに戻るリンクをクリックすると、処理が実行
                document.getElementById('home-link').addEventListener('click', function(event) {
                    //フォームの各入力フィールドを取得
                    let name = document.getElementById('name').value;
                    let content = document.getElementById('content').value;
                    //tags-container内の全てのinputタグを配列で取得
                    let tags = document.querySelectorAll('#tags-container input');

                    //1つでも入力があれば確認ダイアログを表示
                    //Array.from(tags).some(tag => tag.value !== '')
                    //：tagを配列に変換、someで配列内の要素が少なくともvalueプロパティ(内容)が空文字列でない場合にtrueを返す。
                    let hasInput = name !== '' || content !== '' || Array.from(tags).some(tag => tag.value !== '');

                    if (hasInput) {
                        //確認ダイアログ
                        let confirmation = confirm('入力した内容は破棄されますがよろしいでしょうか？');

                        if (!confirmation) {
                            //キャンセルした場合はリンク先に移動しない
                            event.preventDefault();
                        }
                    }
                });

            </script>

        </div>
    </div>
    
    <footer class="bg-gray-600 text-white p-2 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 My Profilesite. オーリス課題用.</p>
        </div>
    </footer>

</body>

</html>