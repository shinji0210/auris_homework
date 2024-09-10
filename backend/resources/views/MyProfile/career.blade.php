

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

<body class="flex flex-col min-h-[100vh] bg-yellow-100">
    <header class="bg-gradient-to-r from-blue-500 to-cyan-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-6">
                <p class="text-white text-3xl font-mochiy">経歴</p>
            </div>
        </div>
    </header>


    <div class="flex justify-between items-start p-4 ">
    <!-- 左側の説明部分 -->
        <div class="text-left text-gray-700 text-lg">
            <p>
                <span class="font-bold">平成27年 3月：</span>岡山県立岡北中学校卒業
            </p>
            <p>
                <span class="font-bold">平成27年 4月：</span>岡山県立岡山一宮高等学校 理数科入学
            </p>
            <p>
                <span class="font-bold">平成30年 3月：</span>岡山県立岡山一宮高等学校 理数科卒業
            </p>
            <p>
                <span class="font-bold">平成30年 4月：</span>岡山私立岡山理科大学 情報科学科入学
            </p>
            <p>
                <span class="font-bold">令和3年 3月：</span>岡山私立岡山理科大学 情報科学科卒業
            </p>
            <p>
                <span class="font-bold">令和3年 4月：</span>専門学校岡山情報ビジネス学院 情報システム学科入学 
            </p>
            <p>
                <span class="font-bold">令和5年 3月：</span>専門学校岡山情報ビジネス学院 情報システム学科卒業
            </p>
            <p>
                <span class="font-bold">令和5年 4月：</span>株式会社ユーコム入社 
            </p>
            <p>
                <span class="font-bold">令和6年 7月：</span>一身上の都合により株式会社ユーコム退社 
            </p>
            <p class="mt-5">
                現在に至る 
            </p>


            <!-- "ホームに戻る" リンク -->
            <div class="mt-10">
                <a href="{{ route('index') }}" class="inline-block px-6 py-1 bg-blue-600 text-white text-lg font-semibold rounded-md hover:bg-blue-700">
                    ホームに戻る
                </a>
            </div>
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
            <p>&copy; 2024 My Website. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>