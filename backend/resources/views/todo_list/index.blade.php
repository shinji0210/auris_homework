

<!DOCTYPE html>
<html lang="ja">

<!--Laravelでは、ビューを表示する用のファイルとして、Bladeテンプレートを使用。-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>テスト</title>
    
    <!-- Tailwind CSSを読み込み -->
    @vite('resources/css/app.css')
</head>
 
<body>
 
    
    <!--todo_listsが空でない場合。-->
    @if ($todo_lists->isNotEmpty())
        <div class="container px-5 mx-auto">
            <ul class="font-medium text-gray-900 bg-white rounded-lg border border-gray-200">
                <!--コントローラーから渡ってきた変数「todol_lists」は、
                「コレクション型」という型の配列のようなもので渡される。-->
            
                @foreach ($todo_lists as $item)
                    <li class="py-4 px-5 w-full rounded-t-lg border-b last:border-b-0 border-gray-200">
                    <!--変数の出力は波括弧を２つ重ねる。-->
                        {{ $item->name }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
 
</body>
 
</html>