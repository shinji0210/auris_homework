

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

<body class="flex flex-col min-h-[100vh] bg-green-100">
    <header class="bg-gradient-to-r from-blue-500 to-cyan-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-6">
                <p class="text-white text-3xl font-mochiy">自己紹介</p>
            </div>
        </div>
    </header>


    <div class="flex justify-between items-start p-4 ">
    <!-- 左側の説明部分 -->
        <div class="text-left text-gray-700 text-lg">
            <p>
                <span class="font-bold">生年月日：</span>平成11年 2月10日生まれ<br>
                <span class="font-bold">出身地：</span>岡山<br>
                <span class="font-bold">性格：</span>穏やか。怒りっぽくない。<br>
                <span class="font-bold">学生時代の部活：</span>中学は美術部、高校は囲碁将棋部<br>
                <span class="font-bold">趣味：</span>ゲーム、動画編集<br>
                <span class="font-bold">現在プレイしてるゲーム(ソーシャルゲーム)：</span>原神, 崩壊スターレイル, ゼンレスゾーンゼロ, ブルーアーカイブ, FGO, モンスターストライク<br>
                <span class="font-bold">現在プレイしてるゲーム(その他)：</span>モンスターハンターワールドアイスボーンPC版(来年Wildsが発売されるので復習がてらプレイ)
            </p>

            <!-- "ホームに戻る" リンク -->
            <div class="mt-10">
                <a href="{{ route('index') }}" class="inline-block px-6 py-1 bg-blue-600 text-white text-lg font-semibold rounded-md hover:bg-blue-700">
                    ホームに戻る
                </a>
            </div>
        </div>

        <!-- 写真部分 -->
        <div class="mx-6">
            <img src="{{ asset('images\mypicture.jpeg') }}" alt="証明写真" class="w-64 h-auto object-cover">
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

        </div>
    </div>

    <footer class="bg-gray-600 text-white p-2 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 My Profilesite. オーリス課題用.</p>
        </div>
    </footer>

</body>

</html>