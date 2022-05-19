<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>一覧</title>
    <meta name="description" content="一覧画面">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <script type="text/javascript">
        //Cookieに値が無ければセット
        var r = document.cookie.indexOf('num');
        var s = document.cookie.indexOf('pull');
        if(r === -1 || s === -1){
            window.location.reload();
            document.cookie = 'num=1';
            document.cookie = 'pull=9';
            document.cookie = 'numpage=1';
            document.cookie = 'pullpage=9';
        }
        var cookies = document.cookie;
        console.log(cookies);
        //JSでCookieに値を保存してリロード
        function load(){
            window.location.reload();
            var numval = document.getElementById('btn-reload').value;
            var pullval = document.getElementById("pulling").value;
            document.cookie = 'num='+numval;
            document.cookie = 'pull='+pullval;
        }
        //投稿、質問のセレクト保持
        function n_update(numdata){
            document.getElementById('btn-reload').querySelector("option[value='"+numdata+"']").selected = true;
        }
        //時間指定のセレクト保持
        function p_update(pulldata){
            document.getElementById('pulling').querySelector("option[value='"+pulldata+"']").selected = true;
        }
        //windowを閉じたときcookie削除
        $(window).on('beforeunload', function(){
            document.cookie = 'num; max-age=0';
            document.cookie = 'pull; max-age=0';
            document.cookie = 'numpage; max-age=0';
            document.cookie = 'pullpage; max-age=0';
        });
    </script>
</head>

<body>
    <?php
    session_start();

    require_once __DIR__ . '/header.php';

    require_once __DIR__ . '/./dbdata/dbsql.php';

    require_once __DIR__ . '/util.php';
    $user = new User();

    //Cookie削除
    //setcookie('num',1,time()-9);
    //setcookie('pull',9,time()-9);
    //setcookie('numpage',1,time()-9);
    //setcookie('pullpage',9,time()-9);
    
    ?>
    <!--テスト（btn-reload)-->
    <select name="btn-reload" id="btn-reload">
        <option value="1">投稿</option>
        <option value="2">質問</option>
    </select>
    <select name="pulling" id="pulling">
        <option value="9">---------</option>
        <option value="8">新しい順</option>
        <option value="7">古い順</option>
        <option value="1">1ヵ月以内</option>
        <option value="3">3ヵ月以内</option>
        <option value="6">6ヵ月以内</option>
        <option value="12">1年以内</option>
    </select>
    <button type="submit" onclick="load()">更新</button>
    
    <!--title list-->
    <div class="title">
        <b>記事のタイトル一覧</b>
    </div>

    <?php
    $num = $_COOKIE['num'];
    $pull = $_COOKIE['pull'];
    //JS関数呼び出し(selected付与)
    echo "<script> n_update(". $num ."); </script>";
    echo "<script> p_update(". $pull ."); </script>";

    //投稿、質問が切り替わったときページリセット
    if($num !== $_COOKIE['numpage']){
        header('Location: home.php?page_id=1');
        setcookie('numpage',$num);
    }

    //範囲指定が切り替わったときページリセット
    if($pull !== $_COOKIE['pullpage']){
        header('Location: home.php?page_id=1');
        setcookie('pullpage',$pull);
    }

    $user = new User();

    switch ($pull){
        case '9':
        case '8':
            $users = $user->allarticle($num);
            break;
        case '7':
            $users = $user->highlow($num);
            break;
        case '1':
        case '3':
        case '6':
        case '12':
            $users = $user->scopetime($num,$pull);
            break;
        default:
            $users = $user->allarticle($num);
            break;
    }

    define('MAX', '8'); //1ページの記事の表示数


    $users_num = count($users); // トータルデータ件数

    $max_page = ceil($users_num / MAX); // トータルページ数※ceilは小数点を切り捨てる関数

    if (!isset($_GET['page_id'])) { // $_GET['page_id'] はURLに渡された現在のページ数
        $now = 1; // 設定されてない場合は1ページ目にする
    } else {
        $now = $_GET['page_id'];
    }

    $start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか

    // array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る関数
    $disp_data = array_slice($users, $start_no, MAX, true);

    //現在時刻の取得
    $nowtime = new DateTime();

    foreach ($disp_data as $row) { // データ表示
        //現在時刻との差分を取得
        $pasttime = new DateTime($row['date']);
        $diff = $nowtime->diff($pasttime);

        //$test = $diff->format('__%y / %m / %d %h:%i:%s'); //テスト用

        //年・ヵ月・日・時間・分・秒に分ける
        $y = intval($diff->format('%y'));
        $m = intval($diff->format('%m'));
        $d = intval($diff->format('%d'));
        $h = intval($diff->format('%h'));
        $i = intval($diff->format('%i'));
        $s = intval($diff->format('%s'));

        //比較して代入
        if ($y == 0) {
            if ($m == 0) {
                if ($d == 0) {
                    if ($h == 0) {
                        if ($i == 0) {
                            $time = $s . '秒前';
                        } else {
                            $time = $i . '分前';
                        }
                    } else {
                        $time = $h . '時間前';
                    }
                } else {
                    $time = $d . '日前';
                }
            } else {
                $time = $m . 'ヵ月前';
            }
        } else {
            $time = $y . '年前';
        }

    ?>
        <!--ボタン-->
        <!-- foreach($disp_data as $row){ // データ表示 -->

        <section>
            <button onclick="location.href='detail.php?data%5b%5d=<?= $row['articleId'] ?>'" target='_blank' class='btn_ao_a'>
                <span class="a__icon">
                    <img width="50px" src="./images/<?= $row['imagepath'] ?>" alt="<?= $row['userName'] ?>">
                </span>
                <span>
                    <a id="nametag" href="profile.php?userId%5b%5d=<?= $row['userId'] ?>"><?= $row['userName'] ?> </a><?= $time ?>
                </span>
                <span class='a__text'>
                    <?= h($row['title']) ?>
                </span>
            </button>
        </section>

        <!-- <?= $test ?> -->
        <!-- テスト用 -->


    <?php
    }

    //ページネーション
    echo '<nav class="pagination">';
    echo '<div class="nav-links">';
    if ($now > 1) { // リンクをつけるかの判定
        echo '<a class="first page-numbers" href="home.php?page_id=1")>&laquo;</a>' . '';
        echo '<a class="first page-numbers" href="home.php?page_id=' . ($now - 1) . '")>&lsaquo;</a>' . '';
    } else {
        echo '';
    }
    //今のページにはリンクを付けず、他のページにはリンクを付ける、かつ、５ページ分だけ表示
    for ($i = 1; $i <= $max_page; $i++) {
        if ($now < 3 and $i <= 5) {
            if ($i == $now) {
                echo '<span aria-current="page" class="page-numbers current">' . $now . '</span>' . '';
            } else {
                echo '<a class="page-numbers" href="home.php?page_id=' . $i . '">' . $i . '</a>' . '';
            }
        } elseif ($now > $max_page - 3 and $i >= $max_page - 4) {
            if ($i == $now) {
                echo '<span aria-current="page" class="page-numbers current">' . $now . '</span>' . '';
            } else {
                echo '<a class="page-numbers" href="home.php?page_id=' . $i . '">' . $i . '</a>' . '';
            }
        } else {
            if ($i == $now) {
                echo '<span aria-current="page" class="page-numbers current">' . $now . '</span>' . '';
            } elseif ($now - 2 <= $i and $i <= $now + 2) {
                echo '<a class="page-numbers" href="home.php?page_id=' . $i . '">' . $i . '</a>' . '';
            }
        }
    }
    if ($now < $max_page) { // リンクをつけるかの判定
        echo '<a class="next page-numbers" href="home.php?page_id=' . ($now + 1) . '")>&rsaquo;</a>' . '';
        echo '<a class="first page-numbers" href="home.php?page_id=' . $max_page . '")>&raquo;</a>' . '';
    } else {
        echo '';
    }
    echo '</div>';
    echo '</nav>';
    ?>
</body>

</html>