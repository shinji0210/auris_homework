

<!DOCTYPE html>
<html lang="ja">

<!--Laravelでは、ビューを表示する用のファイルとして、Bladeテンプレートを使用。-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>テスト</title>
    
    <!-- Tailwind CSSを読み込み -->
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
 
<body>
 
    
    <!--todo_listsが空でない場合。-->
    <?php if($todo_lists->isNotEmpty()): ?>
        <div class="container px-5 mx-auto">
            <ul class="font-medium text-gray-900 bg-white rounded-lg border border-gray-200">
                <!--コントローラーから渡ってきた変数「todol_lists」は、
                「コレクション型」という型の配列のようなもので渡される。-->
            
                <?php $__currentLoopData = $todo_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="py-4 px-5 w-full rounded-t-lg border-b last:border-b-0 border-gray-200">
                    <!--変数の出力は波括弧を２つ重ねる。-->
                        <?php echo e($item->name); ?>

                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
 
</body>
 
</html><?php /**PATH /work/backend/resources/views/todo_list/index.blade.php ENDPATH**/ ?>