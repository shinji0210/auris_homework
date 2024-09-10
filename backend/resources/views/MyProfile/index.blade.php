

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

    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-[100vh]">

    <!-- ヘッダー -->
    <header class="bg-gradient-to-r from-blue-500 to-cyan-500">
        <div class="max-w-7xl mx-auto px-2 sm:px-6">
            <div class="py-6">
                <p class="text-white text-3xl font-mochiy">shinjiの自己紹介ページ</p>
            </div>
        </div>
    </header>

    <div class="flex justify-between items-start p-4 bg-gray-100">
    <!-- 左側の説明部分 -->
        <div class="text-left text-gray-700 text-lg">
            <h1 class="text-2xl font-bold text-black mb-4">
                shinjiの自己紹介ページへようこそ！
            </h1>
            <p>
                右のタブから各ページに移れます。何かあれば下記のコメントにてお願いします！
            </p>
            <h2 class="text-xl font-bold text-black mt-10 mb-4">
                コメントについて
            </h2 class="relative mt-4">
            <p>
                コメントを送る際にタグをつけて送ることができます。タグをつけることにより投稿が検索しやすくなります。
            </p>
        </div>

        <div class="flex flex-col space-y-0">

            <!-- 自己紹介へ向かう用のボタン -->
            <a href="{{ route('self_introduction') }}" class="relative mt-0 ml-auto block w-40 h-14 text-white flex items-center text-2xl font-semibold bg-sky-700
                border-2 border-green-200 transition-all duration-300 
                hover:bg-yellow-500 hover:border-black">
                　自己紹介
            </a>

            <!-- 経歴へ向かう用のボタン -->
            <a href="{{ route('career') }}" class="relative mt-0 ml-auto block w-40 h-14 text-white flex items-center text-2xl font-semibold bg-sky-700
                border-2 border-green-200 transition-all duration-300 
                hover:bg-yellow-500 hover:border-black">
                　経歴
            </a>

            <!-- やりたいことへ向かう用のボタン -->
            <a href="{{ route('want_to_do') }}" class="relative mt-0 ml-auto block w-40 h-14 text-white flex items-center text-2xl font-semibold bg-sky-700
                border-2 border-green-200 transition-all duration-300 
                hover:bg-yellow-500 hover:border-black">
                　やりたいこと
            </a>

            <!-- 特技へ向かう用のボタン -->
            <a href="{{ route('skill') }}" class="relative mt-0 ml-auto block w-40 h-14 text-white flex items-center text-2xl font-semibold bg-sky-700
                border-2 border-green-200 transition-all duration-300 
                hover:bg-yellow-500 hover:border-black">
                　特技
            </a>

            <!-- 投稿管理画面へ向かう用のボタン -->
            <!-- クリックするとパスワード入力ポップアップを開くopenPasswordModalを実行 -->
            <button onclick="openPasswordModal()" class="relative mt-0 ml-auto block w-20 h-8 text-black flex items-center text-xl font-semibold bg-slate-300
                border-2 border-black transition-all duration-300 
                hover:bg-slate-400 hover:border-black">
                管理
            </button>

        </div>
    </div>

    <div class="flex justify-between items-start p-4 bg-orange-200">

        <a href="{{ route('post_form') }}" class="inline-block px-3 py-1 bg-orange-600 text-white text-lg font-semibold rounded-md hover:bg-orange-800">
            投稿
        </a>
    </div>
    

    

    <footer class="bg-gray-600 text-white p-2 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 My Website. All rights reserved.</p>
        </div>
    </footer>

    <!-- パスワード入力ポップアップモーダル -->
    <!-- fixed:スクロールしても常に画面に表示される -->
    <!-- inset-0: 上下左右の位置を0に設定し、画面全体をカバー -->
    <!-- flex items-center justify-center: フレックスボックスを使い、モーダルの内容を画面の中央に配置 -->
    <!-- bg-black bg-opacity-50: モーダルの背景を半透明の黒に設定し、背景を暗くしてモーダルに注目させる -->
    <!-- hidden: 初期状態ではモーダルを非表示にします。JavaScriptで表示する際にこのクラスを削除 -->
    <div id="passwordModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <!-- モーダルのデザイン設定 -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <!-- タイトル -->
            <h2 class="text-xl font-semibold mb-4">パスワードを入力してください</h2>
            <!-- passwordForm：参照用のID -->
            <!-- action=：フォームが送信される先のURLを指定 -->
            <!-- check_passwordのルートにPOSTリクエストが送信される。 -->
            <form id="passwordForm" action="{{ route('check_password') }}" method="POST">
                @csrf
                <!-- パスワード入力欄 -->
                <!-- プレースホルダーも設定 -->
                <input type="password" name="password" class="border-2 border-gray-300 p-2 w-full mb-4" placeholder="パスワード">
                <!-- 送信ボタンデザイン -->
                <button type="submit" class="px-4 py-2 bg-sky-700 text-white rounded-md hover:bg-yellow-500">
                    送信
                </button>
                <!-- キャンセルボタンデザイン -->
                <!-- type="button"：このボタンがフォームを送信しないことを指定 -->
                <button type="button" onclick="closePasswordModal()" class="ml-4 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700">
                    キャンセル
                </button>
            </form>
        </div>
    </div>

    <!-- エラーメッセージ用ポップアップモーダル -->
    <div id="errorModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-red-500 mb-4">エラー</h2>
            <p class="text-red-500">パスワードが違います。</p>
            <button onclick="closeErrorModal()" class="mt-4 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700">
                閉じる
            </button>
        </div>
    </div>

    <script>
        //パスワード入力表示
        //passwordModalが表示
        function openPasswordModal() {
            //hidden クラスを削除し、モーダルを画面に表示
            document.getElementById('passwordModal').classList.remove('hidden');
        }

        //パスワード入力非表示
        function closePasswordModal() {
            //hidden クラスを追加し、モーダルを画面から隠す
            document.getElementById('passwordModal').classList.add('hidden');
        }

        //パスワードエラーメッセージ表示
        function openErrorModal() {
            document.getElementById('errorModal').classList.remove('hidden');
        }

        //パスワードエラーメッセージ非表示
        function closeErrorModal() {
            document.getElementById('errorModal').classList.add('hidden');
        }

        // ページ読み込み時にエラーがある場合、自動的にエラーモーダルを表示
        @if (session('error'))
            window.onload = function() {
                openErrorModal();
            }
        @endif
    </script>
</body>

</html>