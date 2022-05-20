<!DOCTYPE html>
<html>

<head>
    <title>投稿記事一覧</title>
    <link rel="stylesheet" type="text/css" href="css/detail.css">
    <script type="text/javascript">
        //未入力なら送信しない、入力があるならリロードして表示
        function comment_update(){
            window.setTimeout(function(){
                window.location.reload();
            },100);
        }
        //文字数カウント
        function commentlen(){
            var len = document.getElementById("comment").value.length;
            document.getElementById("comment_num").innerText = len + "/160";
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

<body bgcolor="#d9ead3" style="padding: 0;">
    <!--<button onclick="location.href='home.php'">戻る</button>-->
    <table>
        <tr>
            <td>
                <img src=" images/<?= $users['imagepath'] ?>" alt="アイコン" width="20" height="20">
            </td>
            <td>
                <p><?= h($users['userName']) ?></p>
            </td>
        </tr>
    </table>


    <ul style="list-style-type: circle;">
    </ul>

    <table style="border-collapse: collapse; width: 1045px; margin: 0 auto;" border="1">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: left; padding-left: 40px;"><?= h($users['title']) ?></p>
                    <textarea disabled style="border: none; background-color: #d9ead3; color: inherit; width: 900px; height: 300px;" name=”テキストエリア” rows=”3″ cols=”50″ wrap=”hard”><?= h($users['explanation']) ?></textarea>
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
                    <br>
                    <?php
                    if (h($users['urlpath']) != null) {
                    ?>
                        <a href="<?php echo $users['urlpath'] ?>"><?php echo h($users['urlpath']) ?></a>
                    <?php
                    }
                    ?>

                </td>
            </tr>
        </tbody>
    </table>
    <div class="button">
        <button>いいね！👍 999</button>
        <button>低評価👎 0</button>
    </div>

    <?php
    $_SESSION['ORnum'] = $users['ORnum'];
    //詳細が製作物の時
    if ($_SESSION['ORnum'] == 1) {
        $get_comment = $user->get_comment($_SESSION['articleId'],$_SESSION['ORnum']);
        echo '<p style="margin-right: 1000px">コメント</p>';
    }elseif ($_SESSION['ORnum'] == 2){
        $get_answers = $user->get_answers($_SESSION['articleId']);
        echo '<p style="margin-right: 1000px">質問回答</p>';
    }
    ?>
        <form id="comment_form" method="POST" action="ORnum.php" target="sendPhoto">
            <textarea id="comment" name="comment" style="width: 1045px; height: 300px;" cols="50" rows="1" maxlength="1000" onkeyup="commentlen();"></textarea>
            <div id="comment_num">0/160</div>
            <?php
                //入力エラーがあるならば表示
                if(isset($_SESSION['text_error'])){
                    echo '<p class="error_class" style="color:red;">'. $_SESSION['text_error'].'</p>';
                    unset($_SESSION['text_error']);
                }
            ?>
            <div class="btn">
                <button type="submit" class="Form-Btn pos" onclick="comment_update()">送信</button>
            </div>
        </form>
        <iframe name="sendPhoto" style="width:0px;height:0px;border:0px;"></iframe>

        <?php
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
                            echo h($row['comment']);
                        }elseif($_SESSION['ORnum']==2){
                            echo h($row['answer']);
                        }
                    ?>
                </span>
            </section>
        <?php
        }

    ?>
</body>