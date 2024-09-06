<!DOCTYPE html>
<html lang="ja">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
 
    <!-- Tailwind CSSを読み込み -->
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
 
<body class="flex flex-col min-h-[100vh]">
    <header class="bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-6">
                <p class="text-white text-xl">Todoアプリ</p>
            </div>
        </div>
    </header>
 
    <main class="grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-[100px]">
                <p class="text-2xl font-bold text-center">今日は何する？</p>

                <!-- タスクを入力するテキスト入力欄（name属性の値はtask_nameとしています）と、ボタンをformタグで囲む -->
                <form action="/tasks" method="post" class="mt-10">

                <!-- formタグを使用する際には以下のように<?php echo csrf_field(); ?>の記述が必須 -->
                <!-- 送信されるリクエストに正しいトークンが含まれ、セッションに入っているトークンの値と一致しているかサーバーで検証される -->
                  <?php echo csrf_field(); ?>
 
                  <div class="flex flex-col items-center">
                    <label class="w-full max-w-3xl mx-auto">
                        <!-- ここのtask_nameがTaskController.phpのstore内のtask_nameに繋がる -->    
                        <input
                            class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                            placeholder="洗濯物をする..." type="text" name="task_name" />
                            
                            <!-- エラーメッセージ表示 -->
                            <!-- 指定のキー名に対するエラーが発生しているかチェックし、もし発生していたら、それに対応するエラー文をmessageで出力 -->
                            <?php $__errorArgs = ['task_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        <?php echo e($message); ?>

                                    </p>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </label>
 
                    <!-- 追加するボタンを押したら、DBに保存したいので、TaskController.phpのstoreメソッドを使う。 -->
                    <!-- なので、formのアクション属性は「/tasks」で、methodはPOSTに設定 -->
                    <button type="submit" 
                    class="mt-8 p-4 bg-slate-800 text-white w-full max-w-xs hover:bg-slate-900 transition-colors">
                        追加する
                    </button>
                  </div>
 
                </form>

                <!-- タスクの表示 -->
                <!-- tasks→isNotEmpty()を実行することで、モデルのレコードが存在するかどうか確認し、レコードが無い場合は、divタグを表示しない。 -->
                <?php if($tasks->isNotEmpty()): ?>
                    <div class="max-w-7xl mx-auto mt-20">
                        <div class="inline-block min-w-full py-2 align-middle">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                タスク</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    <!-- foreachディレクティブにより、モデルのレコードをループで回して表示 -->
                                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <!-- タスク名の表示 -->
                                                <td class="px-3 py-4 text-sm text-gray-500">
                                                    <div>
                                                        <?php echo e($item->name); ?>

                                                    </div>
                                                </td>
                                                <td class="p-0 text-right text-sm font-medium">
                                                    <div class="flex justify-end">

                                                        <!-- 完了ボタン PUTとしてリクエストを送る-->
                                                        <div>
                                                            <form action="/tasks/<?php echo e($item->id); ?>"
                                                                method="post"
                                                                class="inline-block text-gray-500 font-medium"
                                                                role="menuitem" tabindex="-1">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PUT'); ?>

                                                                <!-- 編集ボタンと区別するために追加 -->
                                                                <input type="hidden" name="status" value="<?php echo e($item->status); ?>">
                                                                <button type="submit"
                                                                    class="bg-emerald-700 py-4 w-20 text-white md:hover:bg-emerald-900 transition-colors">完了</button>
                                                            </form>
                                                        </div>

                                                        <!-- 編集ボタン レコードID：edit-->
                                                        <!-- リソースコントローラーのeditメソッドを呼び出し、editメソッド内で編集画面のビュー（この後作成）を返すようにするため -->
                                                        <div>
                                                            <a href="/tasks/<?php echo e($item->id); ?>/edit/"
                                                                class="inline-block text-center py-4 w-20 underline underline-offset-2 text-sky-600 md:hover:bg-sky-100 transition-colors">編集</a>
                                                        </div>

                                                        <!-- 削除ボタン DELETEとしてリクエストを送る-->
                                                        <div>
                                                            <form onsubmit="return deleteTask();"
                                                                action="/tasks/<?php echo e($item->id); ?>" method="post"
                                                                class="inline-block text-gray-500 font-medium"
                                                                role="menuitem" tabindex="-1">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                                <button type="submit"
                                                                    class="py-4 w-20 md:hover:bg-slate-200 transition-colors">削除</button>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>


            </div>
        </div>
    </main>
    <footer class="bg-slate-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="py-4 text-center">
            <p class="text-white text-sm">Todoアプリ</p>
        </div>
    </div>
    </footer>

    <!-- body閉じタグ直前にJavaScriptを記述 -->
    <script>
    function deleteTask() {
        // confirmメソッドを呼び出すことで、ブラウザ標準の確認モーダルが表示
        if (confirm('本当に削除しますか？')) {
            return true;
        } else {
            return false;
        }
    }
    </script>
</body>
 
</html><?php /**PATH /work/backend/resources/views/tasks/index.blade.php ENDPATH**/ ?>