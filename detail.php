<!DOCTYPE html>
<html>

<head>
    <title>投稿記事一覧</title>
    <link rel="stylesheet" type="text/css" href="css/detail.css">
    <script type="text/javascript">
        //0.1秒遅らして送信
        function comment_update(){
            window.setTimeout(function(){
                window.location.reload();
            },100);
        }
    </script>
</head>


<?php
session_start();
require_once __DIR__ . './header.php';
require_once __DIR__ . '/./dbdata/dbsql.php';
require_once __DIR__ . '/util.php';
require_once __DIR__ . '/url.php';

$user = new User();
$data = $_GET['data'];
$users = $user->authUser($data[0]);
$_SESSION['articleId'] = $data[0];


//$get_comment = $user->get_comment($_SESSION['articleId']);
?>

<body>
    <table>
        <tbody>
            <tr>
                <td>
                    <p class="username"><img src=" images/<?= $users['imagepath'] ?>" alt="アイコン" width="20" height="20"><?= h($users['userName']) ?></p>
                </td>
            </tr>
            <tr>
                <td class="border">
                    <!-- タイトル部分　-->
                    <p><?= h($users['title']) ?></p>
                    <!-- 本文 -->
                    <textarea name=”テキストエリア” class="user_text" cols=”50″ rows=”5″ disabled><?= h($users['explanation']) ?></textarea>
                    <!-- 画像表示処理 -->
                    <?php
                    for ($i = 1; $i <= 4; $i++) {
                        if ($users['articleimg' . $i] != null) {
                    ?>
                            <img src=" images/<?= $users['articleimg' . $i] ?>" width="100" height="100">
                    <?php
                        }
                    }
                    ?>
                    <br>
                    <!-- URL表示処理 -->
                    <?php if (h($users['urlpath']) != null) { ?>
                        <a href="<?php echo $users['urlpath'] ?>" target="__blank" rel="noopener noreferrer"><?php echo h($users['urlpath']) ?></a>
                    <?php } ?>
                    <!-- 評価ボタン -->
                    <div class="button">
                        <button>いいね！👍 999</button>
                        <button>低評価👎 0</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <hr>

    <?php
    $_SESSION['ORnum'] = $users['ORnum'];
    //コメント、質問答え入力フォーム
    if ($_SESSION['ORnum'] == 1) {
        $get_comment = $user->get_comment($_SESSION['articleId'],$_SESSION['ORnum']);
        $title = 'コメント';
    }elseif ($_SESSION['ORnum'] == 2){
        $get_answers = $user->get_answers($_SESSION['articleId']);
        $title = '質問解答';
    }
    ?>
    <table>
        <tbody>
            <tr>
                <td>
                    <p><?= $title ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <form id="comment_form" method="POST" action="ORnum.php" target="sendPhoto">
                        <textarea id="comment" name="comment" cols="50" rows="5" maxlength="160" placeholder="160文字以内"></textarea>
                        <?php
                            //入力エラーがあるならば表示
                            if(isset($_SESSION['text_error'])){
                                echo '<p class="error_class" style="color:red;">'. $_SESSION['text_error'].'</p>';
                                unset($_SESSION['text_error']);
                            }
                        ?>
                        <div class="button">
                            <button type="submit" class="Form-Btn" onclick="comment_update()">送信</button>
                        </div>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>

    <hr>

    <iframe name="sendPhoto"></iframe>
    <?php
    //投稿・質問で分岐
    if($_SESSION['ORnum']==1){
        $line_up = $get_comment;
    }elseif($_SESSION['ORnum']==2){
        $line_up = $get_answers;
    }
    //コメント表示
    foreach ($line_up as $row) {
        $url_param = url_param_change(array("userId" => $row['userId']))
    ?>
    <section>
        <button onclick="location.href='transition_profile.php?<?php echo $url_param; ?>'" target='_blank' class='btn_ao_a'>
            <span class="a__icon">
                <img width="20px" src="./images/<?= $row['imagepath'] ?>" alt="<?= h($row['userName']) ?>">
            </span>
            <span>
                <a id="nametag"><?= h($row['userName']) ?></a>
            </span>
        </button>
        <span class="comment">
            <?php
                if($_SESSION['ORnum']==1){
                    echo '<p>'.h($row['comment']).'</p>';
                }elseif($_SESSION['ORnum']==2){
                    echo '<p>'.h($row['answer']).'</p>';
                }
            ?>
        </span>
        <hr id="hrhr">
    </section>
    <?php
    }
    ?>
</body>
</html>