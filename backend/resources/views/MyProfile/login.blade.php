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

<!-- 追加 2024/10/21 管理者とゲストのURLを分ける -->
<!-- 管理者とゲストを分けるためのログイン画面作成 -->


<body class="flex flex-col min-h-[100vh]">
    <!-- ヘッダー -->
    <header class="bg-gradient-to-r from-blue-500 to-cyan-500">
        <div class="max-w-7xl mx-auto px-2 sm:px-6">
            <div class="py-6">
                <p class="text-white text-3xl font-mochiy">ログインページ</p>
            </div>
        </div>
    </header>


    @if (session('alert'))
        <script>
            alert('{{ session('alert') }}');
        </script>
    @endif

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md bg-white p-8 ">
            

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <h1 class="text-2xl font-bold my-6 text-center">ログイン</h1>
                    <p>管理者として入るにはパスワードを入力してログインボタンを押してください。</p>
                    <p>管理者でない場合は、ゲストボタンを押してください。</p>
                    <!-- エラーメッセージの表示(パスワードが空の場合、もしくは間違えていた場合。) -->
                    @if ($errors->any())
                        <div class="mb-6">
                            <ul class=" text-red-500 p-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- パスはAuthControllerに記載 -->
                    <label for="password" class="block text-gray-700 font-bold my-2">パスワード:</label>
                    <input type="password" name="password" id="password" class="my-2 w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="flex justify-between items-center my-2">
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700 mr-3">管理者としてログイン</button>
                    <a href="{{ route('index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700">ゲストとして入る</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>