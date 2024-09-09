

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
    <header class="bg-gradient-to-r from-blue-500 to-cyan-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-6">
                <p class="text-white text-3xl font-mochiy">自己紹介</p>
            </div>
        </div>
    </header>


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
</body>

</html>