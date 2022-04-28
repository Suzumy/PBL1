<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>一覧</title>
        <meta name="description" content="一覧画面">
        <link rel="stylesheet" type="text/css" href="css/home.css">
    </head>
    <script type="text/javascript" src="jquery.pagination.js"></script>
    <body>
        <?php
            session_start();

            require_once __DIR__.'/header.php';

            require_once __DIR__.'/./dbdata/dbsql.php';
            $user = new User();

            $users = $user->allarticle();
        ?>
        <!--title list-->
        <div class="title">
            <b>記事のタイトル一覧</b>
        </div>

        <?php

            define('MAX','4'); //1ページの記事の表示数

            $users_num = count($users); // トータルデータ件数

            $max_page = ceil($users_num / MAX); // トータルページ数※ceilは小数点を切り捨てる関数

            if(!isset($_GET['page_id'])){ // $_GET['page_id'] はURLに渡された現在のページ数
                $now = 1; // 設定されてない場合は1ページ目にする
            }else{
                $now = $_GET['page_id'];
            }
             
            $start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか
             
            // array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る関数
            $disp_data = array_slice($users, $start_no, MAX, true);

            foreach($disp_data as $row){ // データ表示
        ?>
                <section>
                    <button onclick="location.href='detail.php?data%5b%5d=<?= $row['articleId']?>'" target='_blank' class='btn_ao_a'>
                        <span class="a__icon">
                            <img width="50px" src="./images/<?= $row['imagepath'] ?>" alt="<?= $row['userName'] ?>">
                        </span>
                        <span>
                            <a id="nametag" href="profile.php"><?= $row['userName'] ?></a>
                        </span>
                        <span class='a__text'>
                            <?= $row['title'] ?>
                        </span>
                    </button>
                </section>
        <?php
            }

            //ページネーション
            echo '<nav class="pagination">';
                echo '<div class="nav-links">';
                    if($now > 1){ // リンクをつけるかの判定
                        echo '<a class="first page-numbers" href="home.php?page_id=1")>&laquo;</a>'. '';
                        echo '<a class="first page-numbers" href="home.php?page_id='.($now - 1).'")>&lsaquo;</a>'. '';
                    } else {
                        echo '';
                    }
                    //今のページにはリンクを付けず、他のページにはリンクを付ける、かつ、５ページ分だけ表示
                    for($i = 1;$i <= $max_page;$i++){
                        if($now < 3 and $i <=5){
                            if($i == $now){
                                echo '<span aria-current="page" class="page-numbers current">'.$now.'</span>'.'';
                            }else{
                                echo '<a class="page-numbers" href="home.php?page_id='.$i.'">'.$i.'</a>'.'';
                            }
                        }
                        elseif($now > $max_page-3 and $i >= $max_page-4){
                            if($i == $now){
                                echo '<span aria-current="page" class="page-numbers current">'.$now.'</span>'.'';
                            }else{
                                echo '<a class="page-numbers" href="home.php?page_id='.$i.'">'.$i.'</a>'.'';
                            }
                        }else{
                            if($i == $now){
                                echo '<span aria-current="page" class="page-numbers current">'.$now.'</span>'.'';
                            }elseif($now -2 <=$i and $i <= $now+2){
                                echo '<a class="page-numbers" href="home.php?page_id='.$i.'">'.$i.'</a>'.'';
                            }
                        }
                    }
                    if($now < $max_page){ // リンクをつけるかの判定
                        echo '<a class="next page-numbers" href="home.php?page_id='.($now + 1).'")>&rsaquo;</a>'. '';
                        echo '<a class="first page-numbers" href="home.php?page_id='.$max_page.'")>&raquo;</a>'. '';
                    } else {
                        echo '';
                    }
                echo '</div>';
            echo '</nav>';
        ?>
    </body>
</html>