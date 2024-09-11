

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

<body class="flex flex-col min-h-[100vh] bg-orange-100">
    <header class="bg-gradient-to-r from-blue-500 to-cyan-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-6">
                <p class="text-white text-3xl font-mochiy">投稿フォーム</p>
            </div>
        </div>
    </header>

    <div class="min-h-screen flex items-start justify-center p-6">
        <div class="text-left max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <!-- 中央、左寄せの文章 -->
            <p class="text-lg text-black mb-4">
                自己紹介ページのホームに載せる投稿を作成できます。<br>
                名前、投稿内容は必須入力です。<br>
                誹謗中傷に当たるような内容はご遠慮ください。
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
            
            @if (session('message'))
                <script>
                    // セッションメッセージをアラートで表示
                    alert('{{ session('message') }}');
                    
                    // 3秒後にホーム画面へ移動
                    setTimeout(function() {
                        window.location.href = "{{ route('index') }}";
                    }, 3000);
                </script>
            @endif

            <form method="POST" action="/post">
                @csrf
                <!-- 名前ラベルと入力欄 -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">名前　※40文字以内</label>
                    <input type="text" id="name" name="name" maxlength="40" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                
                <!-- 投稿内容ラベルと入力欄 -->
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">投稿内容　※200文字以内。</label>
                    <textarea id="content" name="content" maxlength="200" rows="4" class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
                </div>

                    <!-- タグラベルと入力欄。10つまで設定可能 -->
                <div class="mb-4">
                    <label for="tag" class="block text-sm font-medium text-gray-700 mb-1">タグ　※10文字以内。10個まで。</label>

                        <div id="tags-container" class="flex flex-wrap gap-2 mt-2">
                            <input type="text" id="tag_01" name="tag_01" maxlength="10" class="mb-0 w-full p-2 border border-gray-300 rounded-lg" placeholder="タグ">
                            <input type="text" id="tag_02" name="tag_02" maxlength="10" class="mb-0 w-full p-2 border border-gray-300 rounded-lg" placeholder="タグ">
                            <input type="text" id="tag_03" name="tag_03" maxlength="10" class="mb-0 w-full p-2 border border-gray-300 rounded-lg" placeholder="タグ">
                            <input type="text" id="tag_04" name="tag_04" maxlength="10" class="mb-0 w-full p-2 border border-gray-300 rounded-lg" placeholder="タグ">
                            <input type="text" id="tag_05" name="tag_05" maxlength="10" class="mb-0 w-full p-2 border border-gray-300 rounded-lg" placeholder="タグ">
                            <input type="text" id="tag_06" name="tag_06" maxlength="10" class="mb-0 w-full p-2 border border-gray-300 rounded-lg" placeholder="タグ">
                            <input type="text" id="tag_07" name="tag_07" maxlength="10" class="mb-0 w-full p-2 border border-gray-300 rounded-lg" placeholder="タグ">
                            <input type="text" id="tag_08" name="tag_08" maxlength="10" class="mb-0 w-full p-2 border border-gray-300 rounded-lg" placeholder="タグ">
                            <input type="text" id="tag_09" name="tag_09" maxlength="10" class="mb-0 w-full p-2 border border-gray-300 rounded-lg" placeholder="タグ">
                            <input type="text" id="tag_10" name="tag_10" maxlength="10" class="mb-0 w-full p-2 border border-gray-300 rounded-lg" placeholder="タグ">
                        </div>
                </div>
                
                <!-- 投稿ボタン -->
                <div class="mt-0 text-right">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        投稿
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
                document.getElementById('home-link').addEventListener('click', function(event) {
                    // フォームの各入力フィールドを取得
                    let name = document.getElementById('name').value;
                    let content = document.getElementById('content').value;
                    let tags = document.querySelectorAll('#tags-container input'); // タグは複数ある可能性があるので配列で取得

                    // 1つでも入力があれば確認ダイアログを表示
                    let hasInput = name !== '' || content !== '' || Array.from(tags).some(tag => tag.value !== '');

                    if (hasInput) {
                        // 確認ダイアログ
                        let confirmation = confirm('入力した内容は破棄されますがよろしいでしょうか？');

                        if (!confirmation) {
                            // キャンセルした場合はリンク先に移動しない
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