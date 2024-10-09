

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <p class="text-white text-3xl font-mochiy">投稿管理画面</p>
            </div>
        </div>
    </header>
    

    <div class="flex-col items-center bg-indigo-200 ">

        <div class="text-left bg-indigo-100 text-gray-700 text-base">
            <!-- 画面説明 -->
            <p>
                <span class="font-bold">・編集：</span>投稿コメントの編集が行えます。編集したい投稿にチェックを押してから編集ボタンを押せば編集フォームに移行します。<br>
                <span class="font-bold">・削除：</span>投稿コメントの削除が行えます。チェックボックスで複数選択して削除できます。<br>
                <span class="font-bold">・全て選択：</span>現在表示されている投稿リストに全てチェックを付けれます。検索で絞るなどして投稿が非表示になっても、チェック状態は維持されます。<br>
                <span class="font-bold">・全て解除：</span>現在表示されている投稿リストのチェックを全て外します。<br>
                <span class="font-bold">・一括非表示：</span>チェックした投稿を非表示状態にします。実行するとチェックがついていた投稿は<span class="text-red-500">赤文字</span>が入り、ホームに表示されなくなります。<br>
                <span class="font-bold">・非表示の投稿を表示：</span>非表示にした投稿のみ表示します。<br>
                <span class="font-bold">・表示の投稿を表示：</span>ホームに表示されている投稿のみ表示します。<br>
                <span class="font-bold">・タグ絞り込み：</span>タグ絞り込みで入力したタグでの検索を行えます。<br>
                全件表示するにはページを更新するか、検索欄を空にして検索ボタンを押下してください。<br>
                <span class="font-bold">・ホームに戻る</span>ホーム画面に戻ります。<br>
            </p>

        </div>

        <!-- 編集画面で更新処理してきた場合にメッセージ表示 -->
        @if (session('message'))
            <script>
                    // セッションメッセージをアラートで表示
                    alert('{{ session('message') }}');
            </script>
        @endif

        <div class="mt-4 items-center mx-auto max-w-4xl">

            <div>
                <button id="post_edit" class="ml-4 inline-block px-3 py-1 bg-cyan-400 text-black text-lg font-semibold rounded-md hover:bg-cyan-600">
                        編集
                </button>
                <button id="post_delete" class="bg-red-500 text-white inline-block px-3 py-1 text-lg font-semibold rounded-md hover:bg-red-700">
                        削除
                </button>

            </div>
                <!-- タグ絞り込み検索欄 -->
                <div class="flex items-center ml-48 mt-2">
                    <label for="search-tag" class="mr-2 text-lg font-semibold">タグ絞り込み:</label>
                    <input type="text" id="search-tag" class="px-3 py-1 border border-gray-300 rounded-md" placeholder="タグを入力">
                    <button id="search-button" class="ml-2 bg-slate-500 text-white px-3 py-1 rounded-md hover:bg-slate-700">検索</button>
                    <span id="post-count" class="ml-4 text-lg font-semibold text-gray-700"></span>
                </div>

                
        </div>

        <div class="mt-4 items-center mx-auto max-w-4xl">
            <!-- チェックボックス操作用のボタン -->
            <!-- px、pyは余白の設定 -->
            <button id="check-all-button" class="ml-4 bg-green-500 text-white px-4 py-1 rounded-md hover:bg-green-700">
                全て選択
            </button>
            <button id="uncheck-all-button" class="bg-red-500 text-white px-4 py-1 rounded-md hover:bg-red-700">
                全て解除
            </button>

            <button id="batch-hide-button" class="ml-4 bg-orange-600 text-white px-2 py-1 rounded-lg hover:bg-orange-800">
                一括非表示
            </button>

            <button id="batch-unhide-button" class="bg-amber-600 text-white px-2 py-1 rounded-lg hover:bg-amber-800">
                一括表示
            </button>

        </div>

        <div class="mt-1 items-center mx-auto max-w-4xl">
            <button id="filter-true" class="ml-4 bg-stone-500 text-sm text-white px-4 py-1 hover:bg-stone-700">
                非表示の投稿を表示
            </button>
            <button id="filter-false" class="bg-stone-500 text-sm text-white px-4 py-1 hover:bg-stone-700">
                表示されている投稿を表示
            </button>
        </div>

        <!-- "ホームに戻る" リンク -->
        <div class="mt-2 items-center mx-auto max-w-4xl">
            <a href="{{ route('index') }}" class="ml-4 inline-block px-6 py-1 bg-blue-600 text-white text-lg font-semibold rounded-md hover:bg-blue-700">
                ホームに戻る
            </a>
        </div>

        <div class="min-h-screen items-center p-4 mx-auto">
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

        <!-- 投稿表示関連のメソッド -->
        <script>
            //全ての投稿に対するチェック状態を保持するオブジェクト
            const checkedState = {};

            //取得したデータをpostsに保存
            //JavaScriptで使用するためにJSON 形式に変換
            const posts = @json($posts);

            let filteredPosts = posts;
            //1ページに表示する投稿の数を設定
            const postsPerPage = 10;
            //現在のページ番号を管理する変数
            let currentPage = 1;

            //コメントリスト非表示、表示の表示切替
            //post.statusがtrueだと非表示のみ表示
            document.getElementById('filter-true').addEventListener('click', function() {
                filteredPosts = posts.filter(post => post.post_status === '1');
                currentPage = 1; // ページをリセット
                renderPosts(); // 再描画
            });

            document.getElementById('filter-false').addEventListener('click', function() {
                filteredPosts = posts.filter(post => post.post_status === '0');
                currentPage = 1; // ページをリセット
                renderPosts(); // 再描画
            });

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
                    //flexとjustify-between、items-centerを追加することで、投稿内容とチェックボックスが左右中央に配置される。
                    postDiv.className = 'p-4 w-96 bg-white rounded-md shadow-md flex justify-between items-center';
                    
                    //表示する投稿がない場合は処理を抜ける
                    if (!post) {
                        console.log('表示件数0件');
                        return;
                    }

                    //変更 2024/10/8 タグは可変式で登録
                    //タグの表示内容を作成。タグを#付きで表示し、join(' ')` でスペース区切りにする
                    //mapで"#タグ名"の形式に変換
                    //post.tags：MyProfile::with('tags') によって posts に紐付いたmyprofile_posts_tagsのタグ内容
                    //再表示の際、対象が存在しなければ空の配列として設定する。
                    const tags = (post.tags || []).map(tag => `#${tag.tag_content}`).join(' ');


                    // 投稿内容の色を status に応じて変更、postContentClassに代入
                    //非表示の場合、No、名前、内容が赤色になる
                    let postContentClass = 'text-gray-800';
                    if(post.post_status === '1'){
                        postContentClass = 'text-red-600';
                    }
                    
                    //post.created_atはそのままだと2024-09-10T21:33:32.000000Zみたいな表記になるので
                    //日付new DateとtoLocaleStringを用いてyyyy/MM/dd hh:mm:ssの形式にする。
                    //表示する内容をHTML形式で作成

                    //mapで"#タグ名"の形式に変換
                    //最後に配列をjoinでスペースで区切りつつ内容を表示
                    //チェックボックス追加
                    postDiv.innerHTML = `
                        <div>
                            <div class="text-sm text-gray-600 mb-2">${new Date(post.created_at).toLocaleString('ja-JP', { timeZone: 'Asia/Tokyo' })}</div>
                            <div class="mb-2">
                                <div class="text-xs ${postContentClass}">No.${post.post_no} ${post.name}</div>
                                <div class="text-sm ${postContentClass}">${post.post_content}</div>
                            </div>
                            <div class="text-xs text-gray-600 mt-2">
                                ${tags}
                            </div>
                        </div>
                        <div class="ml-4">
                            <input type="checkbox" class="post-checkbox h-4 w-4 text-blue-600">
                        </div>
                    `;

                    //投稿内のチェックボックス要素を取得
                    const checkbox = postDiv.querySelector('.post-checkbox');
                    //checkedState内の対応するpost_noの投稿のチェック状態を反映する。設定がない場合、チェックは入らない。
                    //これにより、投稿ページが切り替わってもチェックの状態が維持される。
                    checkbox.checked = checkedState[post.post_no] || false;

                    //チェックボックスが変更されたときに実行
                    checkbox.addEventListener('change', function() {
                        //チェックボックスの現在の状態をcheckedStateに保存。
                        checkedState[post.post_no] = this.checked;
                    });

                    //div要素をpostsContainerに追加
                    postsContainer.appendChild(postDiv);
                }

            }

            //一括でチェックボックスにチェックを付ける
            document.getElementById('check-all-button').addEventListener('click', function() {
                //表示された投稿に対してチェック状態をつける
                //checkedState内にはチェック状態が格納されており、
                //filteredPosts内の
                filteredPosts.forEach(post => {
                    checkedState[post.post_no] = true;
                });
                //再描画してチェック状態を反映
                renderPosts(); 
            });

            //一括でチェックボックスのチェックを外す
            document.getElementById('uncheck-all-button').addEventListener('click', function() {
                //表示された投稿に対してチェックを外す
                filteredPosts.forEach(post => {
                    checkedState[post.post_no] = false; // 全てチェックを外す
                });
                //再描画してチェック状態を反映
                renderPosts(); 
            });

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
                    //post.tagsから検索対象のタグリストを取得
                    if (post.tags && post.tags.length > 0) {
                        //some() メソッドを使ってタグのリストをループ処理
                        return post.tags.some(tag => {
                            //タグの内容（tag_content）を小文字に変換し、
                            //searchTag がそのタグの内容に部分一致するかどうかを確認(trueかfalseで返す)
                            return tag.tag_content.toLowerCase().includes(searchTag);
                        });
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

        <!-- 一括非表示がクリックされたときに実行 -->
        <script>
            document.getElementById('batch-hide-button').addEventListener('click', function() {
            //チェックがついている投稿のpost_noをcheckedStateを元に収集
            //チェックされた投稿のpost_no（主キー）だけを取り出して、新しい配列を作成
            const postNos = filteredPosts
                .filter(post => checkedState[post.post_no])
                .map(post => post.post_no);

            if (postNos.length === 0) {
                alert('チェックされた投稿がありません。');
                return;
            }

            //メソッドで実行
            nonDisplay();

            function nonDisplay() {
                if(confirm('本当に非表示にしますか？')){
                    //updateルートに対して非同期のPOSTリクエストを送信
                    //Content-Type：JSON形式のデータを送信
                    //X-CSRF-TOKEN：LaravelのCSRF保護のためにトークンを送信
                    //body～：postNosの内容をJSON形式で送信
                    fetch('{{ route('update') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ postNos: postNos})
                    })
                    //サーバーからのレスポンスをJSON形式に変換
                    .then(response => response.json())
                    .then(data => {
                        //data.successがtrueであればページをリロードして更新された状態を反映
                        //リクエスト中にエラーが発生した場合、エラーメッセージを表示
                        //原因を特定できるようコンソールに出力
                        if (data.success) {
                            alert('チェックした投稿を非表示にしました。');
                            window.location.reload();
                        } else {
                            alert('更新に失敗しました。');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('更新に失敗しました。');
                    });
                }else{
                    return;
                }
            }

        });
        </script>

        <!-- 一括表示がクリックされたときに実行 -->
        <script>
            document.getElementById('batch-unhide-button').addEventListener('click', function() {
            const postNos = filteredPosts
                .filter(post => checkedState[post.post_no])
                .map(post => post.post_no);

            if (postNos.length === 0) {
                alert('チェックされた投稿がありません。');
                return;
            }
            
            onDisplay();

            function onDisplay() {
                if(confirm('本当に表示にしますか？')){
                    //追加でactionに"unhide"を追加
                    fetch('{{ route('update') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ postNos: postNos, action: 'unhide' })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('チェックした投稿を再び表示にしました。');
                            window.location.reload();
                        } else {
                            alert('更新に失敗しました。');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('更新に失敗しました。');
                    });
                }
            }
        });
        </script>

        <!-- 削除ボタンが押されたときに実行 -->
        <script>
            document.getElementById('post_delete').addEventListener('click', function() {
                //※表示、非表示処理の削除バージョン
                const postNos = filteredPosts
                .filter(post => checkedState[post.post_no])
                .map(post => post.post_no);

                if (postNos.length === 0) {
                    alert('削除する投稿をチェックしてください。');
                return;
                }

                deletePost();
                
                function deletePost(){
                    if(confirm('チェックした投稿を本当に削除しますか？\n消した投稿は元に戻せません！')){
                        fetch('{{ route('delete') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ postNos: postNos})
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('チェックした投稿を削除しました。');
                                window.location.reload();
                            } else {
                                alert('削除に失敗しました。');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('削除に失敗しました。');
                        });
                    }else{
                        return;
                    }
                }

            });
        </script>

        <!-- 編集ボタンが押されたときに実行 -->
        <script>
            document.getElementById('post_edit').addEventListener('click', function() {
                //チェックされた投稿を取得
                const checkedPosts = filteredPosts
                .filter(post => checkedState[post.post_no]);

                //チェックが複数ある場合のチェック
                if (checkedPosts.length > 1) {
                    alert('編集する時は一つのみチェックしてください。');
                    return;
                }

                //チェックが一つもない場合のチェック
                if (checkedPosts.length === 0) {
                    alert('編集する投稿をチェックしてください。');
                    return;
                }

                //1つの投稿が選択されているので0番目のチェックリストを取得
                const postToEdit = checkedPosts[0];

                // 変更 2024/10/8 タグは可変式で登録

                // フォームを作成
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("post_form_edit") }}';

                // CSRFトークンをフォームに追加 (LaravelではCSRF保護があるため)
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = '_token';
                tokenInput.value = token;
                form.appendChild(tokenInput);

                // 投稿データをフォームに追加
                const postNoInput = document.createElement('input');
                postNoInput.type = 'hidden';
                postNoInput.name = 'post_no';
                postNoInput.value = postToEdit.post_no;
                form.appendChild(postNoInput);

                const nameInput = document.createElement('input');
                nameInput.type = 'hidden';
                nameInput.name = 'name';
                nameInput.value = postToEdit.name;
                form.appendChild(nameInput);

                const contentInput = document.createElement('input');
                contentInput.type = 'hidden';
                contentInput.name = 'content';
                contentInput.value = postToEdit.post_content;
                form.appendChild(contentInput);

                // タグもフォームに追加 (無制限対応)
                postToEdit.tags.forEach((tag, index) => {
                    const tagInput = document.createElement('input');
                    tagInput.type = 'hidden';
                    tagInput.name = `tags[${index}]`;
                    tagInput.value = typeof tag === 'object' ? tag.tag_content : tag;  // タグがオブジェクトの場合に対応
                    form.appendChild(tagInput);
                });

                // フォームをドキュメントに追加して送信
                document.body.appendChild(form);
                form.submit();
            });
        </script>

    <footer class=" bg-gray-600 text-white p-2 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 My Profilesite. オーリス課題用.</p>
        </div>
    </footer>
</body>

</html>