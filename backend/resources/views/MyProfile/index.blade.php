

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
                右のタブから各ページに移れます。何かあれば下記のコメントに投稿お願いします！
            </p>
            <h2 class="text-xl font-bold text-black mt-10 mb-4">
                コメント投稿について
            </h2 class="relative mt-4">
            <p class="text-base">
                ・投稿ボタンを押下すると専用の投稿フォームに移り、タグをつけて投稿することができます。<br>
                ・無事投稿できたら下記のコメント投稿リストに表示されます。<br>
                ・タグ絞り込みで入力したタグでの検索を行えます。<br>
                ・コメントは最新10件まで表示され、次の投稿、前の投稿ボタンで次の10件が表示されます。<br>
                ・全件表示するにはページを更新するか、検索欄を空にして検索ボタンを押下してください。
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


    <div class="flex-col items-center bg-orange-200 ">
        <div class="flex justify-between items-start p-4 bg-orange-200">
            <a href="{{ route('post_form') }}" class="inline-block px-3 py-1 bg-orange-600 text-white text-lg font-semibold rounded-md hover:bg-orange-800">
                    投稿
            </a>
                
                <!-- タグ絞り込み検索欄 -->
                <div class="flex items-center">
                    <label for="search-tag" class="mr-2 text-lg font-semibold">タグ絞り込み:</label>
                    <input type="text" id="search-tag" class="px-3 py-1 border border-gray-300 rounded-md" placeholder="タグを入力">
                    <button id="search-button" class="ml-2 bg-slate-500 text-white px-3 py-1 rounded-md hover:bg-slate-700">検索</button>
                    <span id="post-count" class="ml-4 text-lg font-semibold text-gray-700"></span>
                </div>

                
        </div>
        <div class="min-h-screen items-center p-4 bg-orange-200 mx-auto">
            <!-- 矢印ボタン -->
            <div class="flex justify-between items-center mx-auto max-w-4xl">
                    <button id="prev-button" class="bg-blue-500 text-white ml-36 px-4 py-1 rounded-md hover:bg-blue-700" style="display: none;">
                        ← 前の投稿
                    </button>
                    <!-- 右端に寄せる -->
                    <button id="next-button" class="bg-blue-500 text-white mx-36 ml-auto px-4 py-1 rounded-md hover:bg-blue-700">
                        次の投稿 →
                    </button>
                </div>
            <!-- 投稿表示エリア -->
            <!-- 投稿が縦に積み重なるように、中央寄せにする -->
            <div id="posts-container" class="mt-4 flex flex-col space-y-4 items-center mx-auto max-w-6xl"></div>
        </div>
    </div>
    
        <script>
            //取得したデータをpostsに保存
            //JavaScriptで使用するためにJSON 形式に変換
            const posts = @json($posts);

            let filteredPosts = posts;
            //1ページに表示する投稿の数を設定
            const postsPerPage = 10;
            //現在のページ番号を管理する変数
            let currentPage = 1;

            // 投稿数を表示するためのメソッド
            function updatePostCount(count) {
                document.getElementById('post-count').textContent = `投稿数: ${count}`;
            }

            //投稿を表示するメソッド
            function renderPosts() {
                //投稿表示エリアのHTML要素を取得
                const postsContainer = document.getElementById('posts-container');
                //内容をクリア
                postsContainer.innerHTML = '';

                //現在のページの最初の投稿の要素番号を取得((現在のページ - 1) * 10)
                const startIndex = (currentPage - 1) * postsPerPage;
                //現在のページの最後の投稿の要素番号を取得。
                //((現在のページの最初の投稿の要素番号 + 10)とデータの数を比較して小さいほうを取得)
                //これにより現在のページ最後の要素番号が最大でも、最初のページ番号*10で打ち止めになる。
                const endIndex = Math.min(startIndex + postsPerPage, posts.length);


                // フィルタリング後の投稿数を更新
                updatePostCount(filteredPosts.length); 

                //前のページに戻るボタンの表示・非表示を設定
                //現在のページが1ページ目の時、前へボタンを表示しない
                //style.displayがnoneかblockで表示が変わる。
                document.getElementById('prev-button').style.display = currentPage > 1 ? 'block' : 'none';
                //次のページに戻るボタンの表示・非表示を設定
                //現在のページの最後の投稿が表示する全体の投稿数より少ないかどうかをチェックして残っていれば表示する
                document.getElementById('next-button').style.display = endIndex < filteredPosts.length ? 'block' : 'none';

                //現在のページに表示する投稿をループして表示
                for (let i = startIndex; i < endIndex; i++) {
                    //検索して絞ったfilteredPostsの中からi番目のpostを取得
                    const post = filteredPosts[i];
                    //新しい div 要素を作成して投稿の内容を設定
                    const postDiv = document.createElement('div');
                    //classの値。投稿の枠のサイズなどを設定
                    postDiv.className = 'p-4 w-96 bg-white rounded-md shadow-md';
                    //post.created_atはそのままだと2024-09-10T21:33:32.000000Zみたいな表記になるので
                    //日付new DateとtoLocaleStringを用いてyyyy/MM/dd hh:mm:ssの形式にする。
                    //表示する内容をHTML形式で作成

                    //タグ：Array.from({ length: 10 }で長さ10の配列を作成。(_, i)で各要素の要素番号を取得。
                    //その中にtag_01～tag_10の値を入れた配列を埋め込む。
                    //その中で空があった時に除外するためにfilterで除外。
                    //mapで"#タグ名"の形式に変換
                    //最後に配列をjoinでスペースで区切りつつ内容を表示
                    postDiv.innerHTML = `
                        <div class="text-sm text-gray-600 mb-2">${new Date(post.created_at).toLocaleString('ja-JP', { timeZone: 'Asia/Tokyo' })}</div>
                        <div class="mb-2">
                            <div class="text-xs">No.${post.post_no} ${post.name}</div>
                            <div class="text-sm text-gray-800">${post.post_content}</div>
                        </div>
                        <div class="text-xs text-gray-600 mt-2">
                            ${Array.from({ length: 10 }, (_, i) => post[`tag_${String(i + 1).padStart(2, '0')}`])
                                .filter(tag => tag)
                                .map(tag => `#${tag}`)
                                .join(' ')}
                        </div>
                    `;
                    //div要素をpostsContainerに追加
                    postsContainer.appendChild(postDiv);
                }

            }

            //タグ検索を実行する関数
            document.getElementById('search-button').addEventListener('click', function() {
                //searchTagに前後の空白が削除され、アルファベットの場合は小文字にした入力値が入る
                const searchTag = document.getElementById('search-tag').value.trim().toLowerCase();


                // 検索欄が空の場合、全投稿を表示し、検索をキャンセル
                if (!searchTag) {
                    //空の検索なら、元のすべての投稿(posts)を保持
                    filteredPosts = posts;
                    //ページをリセット
                    currentPage = 1;   
                    //全投稿を再表示
                    renderPosts();          
                    //全投稿数を更新
                    updatePostCount(filteredPosts.length); 
                    return;
                }

                //タグの部分一致で検索
                //postsから条件に一致する投稿をfilteredPostsに格納
                filteredPosts = posts.filter(post => {
                    //tag_01～tag_10内をfor文で確認。
                    for (let i = 1; i <= 10; i++) {
                            //タグの値をtag内に取得(post['tag_**'])
                            const tag = post[`tag_${String(i).padStart(2, '0')}`];
                            //検索の際に大文字小文字を区別せず、文字列が指定した部分文字列を含んでいるかどうかを確認する。
                            if (tag && tag.toLowerCase().includes(searchTag)) {
                                return true;
                            }
                        }
                    return false;    
                    
                });
                

                currentPage = 1;  // ページをリセット
                renderPosts();     // フィルタリング後の投稿を再表示
            });

            //「前へ」ボタンがクリックされたときの処理。
            //現在のページが 1 より大きい場合にページを減らし、renderPosts() を呼び出して表示を更新
            document.getElementById('prev-button').addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    renderPosts();
                }
            });
            //「次へ」ボタンがクリックされたときの処理。
            //こちらは現在のページ数 * 10がまだ投稿数より小さい場合に表示を更新
            document.getElementById('next-button').addEventListener('click', function() {
                if (currentPage * postsPerPage < posts.length) {
                    currentPage++;
                    renderPosts();
                }
            });

            //初期の投稿数と投稿表示
            updatePostCount(posts.length);
            renderPosts();
        </script>
    

    


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

    <footer class="bg-gray-600 text-white p-2 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 My Profilesite. オーリス課題用.</p>
        </div>
    </footer>
</body>

</html>